import React from "react";
import ReactDOM from "react-dom";
import CardWrapper from "../../CardWrapper/CardWrapper";

const Notifications = () => {
    return <CardWrapper></CardWrapper>;
};

export default Notifications;

if (document.getElementById("root")) {
    ReactDOM.render(<Notifications />, document.getElementById("root"));
}
