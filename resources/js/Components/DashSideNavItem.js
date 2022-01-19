import React from "react";
import { InertiaLink } from "@inertiajs/inertia-react";

const DashSideNavItem = ({ url, name, svg = "", disabled = false }) => {
    let classes =
        window.location.href === url + "/" || window.location.href === url
            ? "text-blue-600 hover:text-blue-700 "
            : "text-gray-700 hover:bg-blue-600 hover:text-gray-100 ";

    classes += disabled ? "" : "";

    return (
        <InertiaLink
            as="button"
            className={`flex w-full items-center px-6 py-3 mt-4 ${classes}`}
            // disabled={disabled ? "true" : "false"}
            href={url}
        >
            {svg}
            <span className="mx-3">{name}</span>
        </InertiaLink>
    );
};

export default DashSideNavItem;
