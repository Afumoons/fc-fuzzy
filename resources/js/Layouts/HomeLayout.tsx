import { useState, PropsWithChildren, ReactNode } from "react";
import ApplicationLogo from "@/Components/ApplicationLogo";
import Dropdown from "@/Components/Dropdown";
import NavLink from "@/Components/NavLink";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink";
import { Link } from "@inertiajs/react";
import { User } from "@/types";
import "bootstrap/dist/css/bootstrap.min.css";

export default function HomeLayout({
    user,
    header,
    children,
    isAdmin,
}: PropsWithChildren<{ user: User; header?: ReactNode; isAdmin: boolean }>) {
    const [showingNavigationDropdown, setShowingNavigationDropdown] =
        useState(false);

    return <h1>f</h1>;
}
