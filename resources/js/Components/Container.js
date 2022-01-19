import React from "react";

const Container = ({ children, className = "" }) => {
    return (
        <div className={` ${className}`}>
            <div className="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {children}
            </div>
        </div>
    );
};

export default Container;
