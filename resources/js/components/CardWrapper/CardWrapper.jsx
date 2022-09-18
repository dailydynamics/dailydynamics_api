import React from "react";

const CardWrapper = (props) => {
    return (
        <div className="container-fluid pt-4 px-4">
            <div className="bg-secondary text-center rounded p-4">
                {props.children}
            </div>
        </div>
    );
};

export default CardWrapper;
