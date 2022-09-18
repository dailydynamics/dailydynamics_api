import React from "react";
import Footer from "../Footer/Footer";
import Navbar from "../NavBar/Navbar";

const Layout = (props) => {
    return (
        <>
            <Navbar />
            {props.children}
            <Footer />
        </>
    );
};

export default Layout;
