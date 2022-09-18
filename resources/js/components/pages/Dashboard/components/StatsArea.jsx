import React from "react";
import SalesCard from "./SalesCard";

const StatsArea = () => {
    return (
        <div className="container-fluid pt-4 px-4">
            <div className="row g-4">
                <SalesCard
                    title={"Todays Sale"}
                    price={"1234"}
                    iconType={"line"}
                />
                <SalesCard
                    title={"Todays Sale"}
                    price={"1234"}
                    iconType={"bar"}
                />

                <SalesCard
                    title={"Todays Sale"}
                    price={"1234"}
                    iconType={"area"}
                />
                <SalesCard
                    title={"Todays Sale"}
                    price={"1234"}
                    iconType={"pie"}
                />
            </div>
        </div>
    );
};

export default StatsArea;
