import React from "react";
import { usePage } from "@inertiajs/inertia-react";
import { InertiaLink } from "@inertiajs/inertia-react";

import DashSideNavItem from "./DashSideNavItem";

const DashSideNav = ({ className = "" }) => {
    const { auth_user } = usePage().props;

    className += ` fixed inset-y-0 left-0 z-50 w-72 overflow-y-auto transition duration-300 transform bg-white md:block md:translate-x-0 md:static md:inset-0`;

    return (
        <div className={`${className}`}>
            <div className="flex items-center justify-center mt-4">
                <div className="flex items-center">
                    <InertiaLink href={route("home")}>
                        <img
                            src="/logo.png"
                            alt=""
                            className="h-20"
                        />
                    </InertiaLink>
                </div>
            </div>

            <nav className="">
                <div>
                    <DashSideNavItem
                        url={route("home")}
                        name="Home"
                        svg={
                            <svg
                                className="w-6 h-6"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                />
                            </svg>
                        }
                    />

                    {auth_user.role === "user" ? (
                        <>
                            <DashSideNavItem
                                url={route("dashboard")}
                                name="Dashboard"
                                svg={
                                    <svg
                                        className="w-6 h-6"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                    >
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            strokeWidth="2"
                                            d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"
                                        ></path>
                                        <path
                                            strokeLinecap="round"
                                            strokeLinejoin="round"
                                            strokeWidth="2"
                                            d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"
                                        ></path>
                                    </svg>
                                }
                            />
                        </>
                    ) : (
                        <>

                        </>
                    )}

                    <hr className="my-4 text-gray-400" />

                    <InertiaLink
                        className="block w-full px-8 py-2 text-left text-gray-500 hover:text-blue-600"
                        href={route("logout")}
                        method="post"
                        as="button"
                    >
                        <span>
                            <svg
                                className="inline-block w-6 h-6 mr-2"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    strokeLinecap="round"
                                    strokeLinejoin="round"
                                    strokeWidth={2}
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"
                                />
                            </svg>
                        </span>
                        Logout
                    </InertiaLink>
                </div>

                {/* {auth_user.role === "user" && (
                    <div className="absolute p-4 border-t border-gray-200">
                        <InertiaLink className="w-full btn btn-lg btn-primary">
                            Deposit
                        </InertiaLink>
                    </div>
                )} */}
            </nav>
        </div>
    );
};

export default DashSideNav;
