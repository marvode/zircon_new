import React, { useState } from "react";
import { InertiaLink } from "@inertiajs/inertia-react";
import { usePage } from "@inertiajs/inertia-react";

const DashNav = ({ sidenavToggle }) => {
    const { auth_user } = usePage().props;
    const [dropdown, setDropdown] = useState(false);

    const toggleDropdown = () => {
        setDropdown(!dropdown);
    };

    return (
        <header className="flex items-center justify-between px-6 py-4 bg-white">
            <div className="flex items-center">
                <button
                    className="text-gray-800 hover:text-gray-700 focus:outline-none md:hidden"
                    onClick={sidenavToggle}
                >
                    <svg
                        className="w-6 h-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            d="M4 6H20M4 12H20M4 18H11"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                        ></path>
                    </svg>
                </button>
            </div>

            <div className="flex items-center">
                <div className="relative">
                    <button
                        className="relative z-30 block px-2 overflow-hidden text-gray-800 focus:outline-none"
                        onClick={toggleDropdown}
                    >
                        <span className="outline-none">
                            {!!auth_user.image_path ? (
                                <img
                                    className="inline object-cover object-center w-8 h-8 rounded-full shadow-inner"
                                    src={auth_user.image_path}
                                    alt="profile picture"
                                />
                            ) : (
                                <img
                                    className="inline h-8"
                                    src="/images/vector/profile.svg"
                                    alt="profile picture"
                                />
                            )}
                        </span>
                        <svg
                            version="1.1"
                            id="Layer_1"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 122.88 66.91"
                            className="inline w-2 h-2 ml-2 fill-current"
                        >
                            <g>
                                <path d="M11.68,1.95C8.95-0.7,4.6-0.64,1.95,2.08c-2.65,2.72-2.59,7.08,0.13,9.73l54.79,53.13l4.8-4.93l-4.8,4.95 c2.74,2.65,7.1,2.58,9.75-0.15c0.08-0.08,0.15-0.16,0.22-0.24l53.95-52.76c2.73-2.65,2.79-7.01,0.14-9.73 c-2.65-2.72-7.01-2.79-9.73-0.13L61.65,50.41L11.68,1.95L11.68,1.95z" />
                            </g>
                        </svg>
                    </button>

                    <div
                        className="fixed inset-0 z-10 w-full h-full"
                        style={{ display: "none" }}
                    ></div>

                    {dropdown && (
                        <>
                            <div
                                className="fixed inset-0 z-20 transition-opacity bg-black opacity-50"
                                onClick={() => setDropdown(false)}
                            ></div>
                            <div className="absolute right-0 z-30 w-48 mt-2 overflow-hidden bg-white rounded shadow-xl">
                                <InertiaLink
                                    // href={route("profile")}
                                    href={"#"}
                                    className="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-600 hover:text-white"
                                >
                                    Profile
                                </InertiaLink>

                                <InertiaLink
                                    className="block w-full px-4 py-2 text-sm text-left text-gray-700 hover:bg-blue-600 hover:text-white"
                                    href={route("logout")}
                                    method="post"
                                    as="button"
                                >
                                    Logout
                                </InertiaLink>
                            </div>
                        </>
                    )}
                </div>
            </div>
        </header>
    );
};

export default DashNav;
