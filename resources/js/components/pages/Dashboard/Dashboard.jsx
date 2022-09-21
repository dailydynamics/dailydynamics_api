import React from "react";
import ReactDOM from "react-dom";
import StatsArea from "./components/StatsArea";
import RecentBookingCard from "./components/RecentBookingCard";
const Dashboard = () => {
    return (
        <>
            <StatsArea />
            <RecentBookingCard />
        </>
    );
};

export default Dashboard;

if (document.getElementById("root")) {
    ReactDOM.render(<Dashboard />, document.getElementById("root"));
}
