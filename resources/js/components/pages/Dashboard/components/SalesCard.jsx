import React from "react";

const SalesCard = ({ title, price, iconType }) => {
    return (
        <div className="col-sm-6 col-xl-3">
            <div className="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                <i className={`fa fa-chart-${iconType} fa-3x text-primary`}></i>
                <div className="ms-3">
                    <p className="mb-2">{title}</p>
                    <h6 className="mb-0">${price}</h6>
                </div>
            </div>
        </div>
    );
};

export default SalesCard;
