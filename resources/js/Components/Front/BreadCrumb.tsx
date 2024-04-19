import { Link } from "@inertiajs/react";
import { HTMLAttributes } from "react";

interface BreadCrumbProps extends HTMLAttributes<HTMLButtonElement> {
    link: string;
    subtitle: string;
}

export default function BreadCrumb({
    className = "",
    children,
    title,
    link,
    subtitle,
    ...props
}: BreadCrumbProps) {
    return (
        <div
            id="breadcrumb"
            className="division"
            style={{
                backgroundImage: 'url("images/article-details-small.jpg")',
                backgroundSize: "cover",
            }}
        >
            <div className="container">
                <div className="row">
                    <div className="col">
                        <div className="breadcrumb-holder">
                            <nav aria-label="breadcrumb">
                                <ol className="breadcrumb">
                                    <li className="breadcrumb-item">
                                        <Link href={route("home")}>Home</Link>
                                    </li>
                                    <li className="breadcrumb-item">
                                        <Link href={link}>{title}</Link>
                                    </li>
                                    <li
                                        className="breadcrumb-item active"
                                        aria-current="page"
                                    >
                                        {subtitle}
                                    </li>
                                </ol>
                            </nav>

                            <h4 className="h4-sm steelblue-color">
                                {subtitle}
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
