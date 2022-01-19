import React from "react";

const BackDrop = ({ onClick }) => {
    return (
        <div
            className="fixed inset-0 z-40 transition-opacity bg-black opacity-50 lg:hidden"
            onClick={onClick}
        ></div>
    );
};

export default BackDrop;
