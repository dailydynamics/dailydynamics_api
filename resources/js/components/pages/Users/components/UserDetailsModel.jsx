import React from "react";
import Button from "react-bootstrap/Button";
import Modal from "react-bootstrap/Modal";
const UserDetailsModel = ({ show, handleClose, user }) => {
    return (
        <Modal show={show} onHide={handleClose} backdrop="static">
            <Modal.Header closeButton>
                <Modal.Title style={{ color: "black" }}>
                    {user.name}
                </Modal.Title>
            </Modal.Header>
            <Modal.Body>
                <p>Email:{user.email}</p>
                <p>Phone:{user.phone}</p>
            </Modal.Body>
            <Modal.Footer>
                <Button variant="secondary" onClick={handleClose}>
                    Close
                </Button>
            </Modal.Footer>
        </Modal>
    );
};

export default UserDetailsModel;
