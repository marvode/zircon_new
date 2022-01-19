import React, { useState } from "react";
import { usePage } from "@inertiajs/inertia-react";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

import DashSideNav from "./DashSideNav";
import DashNav from "./DashNav";
import Container from "./Container";
import BackDrop from "./BackDrop";

const DashLayout = ({ children, title = "", etc = "" }) => {
    const { flash, verified, auth_user } = usePage().props;
    const [navState, setNavState] = useState(false);

    const toggleNav = () => {
        setNavState(!navState);
    };

    return (
        <div>
            <div className="flex h-screen bg-gray-100">
                <DashSideNav className={navState ? "block" : "hidden"} />
                {navState && <BackDrop onClick={() => setNavState(false)} />}

                <div className="flex flex-col flex-1 overflow-hidden">
                    <DashNav sidenavToggle={toggleNav} />

                    {/* App Notifications */}
                    <>
                        {flash.success && (
                            <div className="hidden">
                                {toast.success(flash.success, {
                                    position: "bottom-center",
                                    autoClose: 5000,
                                    hideProgressBar: true,
                                    closeOnClick: true,
                                    pauseOnHover: true,
                                    draggable: true,
                                    progress: undefined,
                                })}
                            </div>
                        )}

                        {flash.error && (
                            <div className="hidden">
                                {toast.error(flash.error, {
                                    position: "bottom-center",
                                    autoClose: 5000,
                                    hideProgressBar: true,
                                    closeOnClick: true,
                                    pauseOnHover: true,
                                    draggable: true,
                                    progress: undefined,
                                })}
                            </div>
                        )}

                        {flash.message && (
                            <div className="hidden">
                                {toast.info(flash.message, {
                                    position: "bottom-center",
                                    autoClose: 5000,
                                    hideProgressBar: true,
                                    closeOnClick: true,
                                    pauseOnHover: true,
                                    draggable: true,
                                    progress: undefined,
                                })}
                            </div>
                        )}

                        <ToastContainer
                            position="bottom-center"
                            autoClose={5000}
                            hideProgressBar
                            newestOnTop={false}
                            closeOnClick
                            rtl={false}
                            pauseOnFocusLoss
                            draggable
                            pauseOnHover
                        />
                    </>

                    <main className="flex-1 pb-6 overflow-x-hidden overflow-y-auto bg-gray-100">
                        {title && (
                            <div className="px-6 pt-6 pb-20 text-gray-50 bg-gradient-to-r to-purple-800 via-indigo-500 from-blue-800">
                                <Container>
                                    <h2 className="text-3xl sm:text-4xl">
                                        {title}
                                    </h2>
                                    {etc}
                                </Container>
                            </div>
                        )}
                        {children}
                    </main>
                    {/* {!verified && (
                        <div className="mb-2 text-sm italic text-center">
                            Please verify your account with an ID (Ignore this
                            message if you submitted your ID)
                        </div>
                    )} */}
                </div>
            </div>
        </div>
    );
};

export default DashLayout;
