import { Modal } from "bootstrap";
import React, { useCallback, useEffect, useState } from "react";
import ReactDOM from "react-dom";
import Swal from "sweetalert2";
import useHttp from "../../../hooks/use-http";
import CardWrapper from "../../CardWrapper/CardWrapper";
import Loader from "../../Loader/Loader";
import ContactDetailsCard from "./components/ContactDetailsCard";

const Contacts = () => {
    const [contactList, setContactList] = useState([]);
    const [selectedContact, setSelectedContact] = useState();
    const transformData = useCallback(
        (result) => setContactList(result.data),
        []
    );

    const {
        isLoading,
        error,
        sendRequest: fetchContacts,
    } = useHttp(transformData);

    const onBack = () => {
        setSelectedContact(undefined);
    };
    const onContactItemClickHandler = (contactId) =>
        setSelectedContact(contactId);

    useEffect(() => {
        fetchContacts({ url: "/api/dashboard/contacts/" });
    }, [fetchContacts]);

    if (isLoading) {
        return <Loader />;
    }
    if (error) {
        Swal.fire({ title: <strong>Error</strong>, icon: "error" });
        return <div></div>;
    }
    if (selectedContact) {
        return (
            <ContactDetailsCard contactId={selectedContact} onBack={onBack} />
        );
    }
    return (
        <CardWrapper>
            <div className="d-flex align-items-center justify-content-between mb-4">
                <h6 className="mb-0">Contact Enquiries</h6>
                <a href="">Show All</a>
            </div>
            <div className="table-responsive">
                <table className="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr className="text-white">
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {contactList.length !== 0 ? (
                            contactList.map((element, index) => (
                                <tr key={element.id}>
                                    <td>{index + 1}</td>
                                    <td>{element.name}</td>
                                    <td>{element.email}</td>
                                    <td>{element.phone}</td>
                                    <td>{element.subject}</td>
                                    <td>{element.message}</td>
                                    <td>
                                        <button
                                            className="btn btn-sm btn-primary"
                                            type="button"
                                            onClick={() =>
                                                onContactItemClickHandler(
                                                    element.id
                                                )
                                            }
                                        >
                                            Detail
                                        </button>
                                    </td>
                                </tr>
                            ))
                        ) : (
                            <></>
                        )}
                    </tbody>
                </table>
            </div>
        </CardWrapper>
    );
};

export default Contacts;
if (document.getElementById("root")) {
    ReactDOM.render(<Contacts />, document.getElementById("root"));
}
