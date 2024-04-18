import { useState, PropsWithChildren, ReactNode, useEffect } from "react";
import { User } from "@/types";
import "../../../public/css/bootstrap.min.css";
import "../../../public/css/flaticon.css";
import "../../../public/css/menu.css";
import "../../../public/css/dropdown-effects/fade-down.css";
import "../../../public/css/magnific-popup.css";
import "../../../public/css/owl.carousel.min.css";
import "../../../public/css/owl.theme.default.min.css";
import "../../../public/css/animate.css";
import "../../../public/css/style.css";
import "../../../public/css/responsive.css";
import FrontHeader from "@/Components/FrontHeader";
import FrontFooter from "@/Components/FrontFooter";

export default function HomeLayout({
    user,
    children,
    isAdmin,
    logoLink,
}: PropsWithChildren<{ user: User; isAdmin: boolean; logoLink?: string }>) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    useEffect(() => {
        const timer = setTimeout(() => {
            const loaderWrapper = document.getElementById("loader-wrapper");
            if (loaderWrapper) {
                loaderWrapper.style.display = "none";
            }
        }, 500);

        return () => clearTimeout(timer);
    }, []);

    return (
        <div className="min-h-screen">
            <div id="loader-wrapper">
                <div id="loader">
                    <div className="loader-inner"></div>
                </div>
            </div>
            <div id="page" className="page">
                <FrontHeader user={user} imageLink={logoLink} />

                {children}

                <FrontFooter />
            </div>
        </div>
    );
}
