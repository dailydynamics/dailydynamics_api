import React, { useCallback, useEffect, useState } from "react";
import CardWrapper from "../../../CardWrapper/CardWrapper";
import useHttp from "../../../../hooks/use-http";
import Loader from "../../../Loader/Loader";
import Swal from "sweetalert2";

const ContactDetailsCard = ({ contactId, onBack }) => {
    const [contact, setContact] = useState();

    const transformData = useCallback((result) => setContact(result.data), []);
    const {
        isLoading,
        error,
        sendRequest: fetchContactDetails,
    } = useHttp(transformData);
    useEffect(() => {
        fetchContactDetails({ url: `/api/dashboard/contacts/${contactId}` });
    }, [fetchContactDetails]);
    if (isLoading) {
        return <Loader />;
    }
    if (error) {
        Swal.fire({ title: <strong>Error</strong>, icon: "error" }).then(() =>
            onBack()
        );
    }
    if (contact) {
        return (
            <CardWrapper>
                <div className="d-flex align-items-center justify-content-between mb-4">
                    <h6 className="mb-0">Contact Details</h6>
                    <button
                        type="button"
                        onClick={onBack}
                        className="btn btn-primary"
                    >
                        Back
                    </button>
                </div>
                <div className="container">
                    <div className="row">
                        <div className="col-6">{contact.name}</div>
                        <div className="col-6">{contact.email}</div>
                    </div>
                    <div className="row">
                        <div className="col-6">{contact.phone}</div>
                        <div className="col-6">{contact.subject}</div>
                    </div>
                    <div className="row">
                        <div className="col-12">{contact.message}</div>
                    </div>
                </div>
            </CardWrapper>
        );
    }
    return <></>;
};

export default ContactDetailsCard;
