import React, { useCallback, useEffect, useState } from "react";
import ReactDOM from "react-dom";
import Loader from "../../Loader/Loader";
import useHttp from "../../../hooks/use-http";
import CardWrapper from "../../CardWrapper/CardWrapper";
import Swal from "sweetalert2";
import UserDetailsModel from "./components/UserDetailsModel";
const UsersPage = () => {
    const [userList, setUserList] = useState([]);
    const [show, setShow] = useState(false);
    const [selectedUser, setSelectedUser] = useState();

    const handleClose = () => setShow(false);

    const transformData = useCallback((result) => setUserList(result.data), []);
    const transformUserData = useCallback((result) => {
        setSelectedUser(result.data);
        setShow(true);
    }, []);

    const {
        isLoading,
        error,
        sendRequest: fetchUsers,
    } = useHttp(transformData);

    const {
        isLoading: load,
        error: err,
        sendRequest: fetchUser,
    } = useHttp(transformUserData);

    const onClickShowHandler = (id) => {
        fetchUser({ url: `/api/dashboard/user/${id}` });
    };

    useEffect(() => {
        fetchUsers({ url: "/api/dashboard/user/" });
    }, [fetchUsers]);

    if (isLoading || load) {
        return <Loader />;
    }
    if (error || err) {
        Swal.fire({ title: <strong>Error</strong>, icon: "error" });
        return <div></div>;
    }

    const onItemDelete = (id) => {
        Swal.fire({
            title: "Do you want to Delete?",
            showDenyButton: true,
            confirmButtonText: "Yes",
            denyButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", "", "success");
            }
        });
    };

    return (
        <>
            {selectedUser && (
                <UserDetailsModel
                    show={show}
                    handleClose={handleClose}
                    user={selectedUser}
                />
            )}
            <CardWrapper>
                <div className="d-flex align-items-center justify-content-between mb-4">
                    <h6 className="mb-0">Users</h6>
                </div>
                <div className="table-responsive">
                    <table className="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr className="text-white">
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {userList.length !== 0 ? (
                                userList.map((element, index) => (
                                    <tr key={element.id}>
                                        <td>{index + 1}</td>
                                        <td>{element.name}</td>
                                        <td>{element.email}</td>
                                        <td>{element.phone}</td>
                                        <td>
                                            <button
                                                className="btn btn-primary"
                                                onClick={(e) =>
                                                    onClickShowHandler(
                                                        element.id
                                                    )
                                                }
                                            >
                                                <i className="fa fa-eye"></i>
                                            </button>
                                            <button
                                                style={{ marginLeft: "1rem" }}
                                                className="btn btn-primary"
                                                onClick={() =>
                                                    onItemDelete(element.id)
                                                }
                                            >
                                                <i className="fa fa-trash"></i>
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
        </>
    );
};

export default UsersPage;
if (document.getElementById("root")) {
    ReactDOM.render(<UsersPage />, document.getElementById("root"));
}
