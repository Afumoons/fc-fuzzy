import { User } from "@/types";
import { Link } from "@inertiajs/react";

interface FrontHeaderProps {
    user: User;
    className?: string;
    imageLink?: string;
}

export default function FrontHeader({
    user,
    className = "",
    imageLink,
    ...props
}: FrontHeaderProps) {
    return (
        <header id="header" {...props} className={`header ${className}`}>
            <div className="wsmobileheader clearfix">
                <Link href="#" id="wsnavtoggle" className="wsanimated-arrow">
                    <span></span>
                </Link>
                <span className="smllogo">
                    <img
                        src="images/logo-grey.png"
                        width="180"
                        height="40"
                        alt="mobile-logo"
                    />
                </span>
                <Link href="tel:12341234" className="callusbtn">
                    <i className="fas fa-phone"></i>
                </Link>
            </div>

            <div className="headtoppart bg-blue clearfix">
                <div className="headerwp clearfix">
                    <div className="headertopleft">
                        <div className="address clearfix">
                            <span>
                                <i className="fas fa-map-marker-alt"></i>UPN
                                Veteran Jatim
                            </span>
                            <Link
                                href={route("whatsapp")}
                                className="callusbtn"
                            >
                                <i className="fas fa-phone"></i>
                                087744554566
                            </Link>
                        </div>
                    </div>
                    <div className="headertopright">
                        <Link className="googleicon" title="Google" href="#">
                            <i className="fab fa-google"></i>
                            <span className="mobiletext02">Google</span>
                        </Link>
                        <Link
                            className="linkedinicon"
                            title="Linkedin"
                            href="#"
                        >
                            <i className="fab fa-linkedin-in"></i>
                            <span className="mobiletext02">Linkedin</span>
                        </Link>
                        <Link className="twittericon" title="Twitter" href="#">
                            <i className="fab fa-twitter"></i>
                            <span className="mobiletext02">Twitter</span>
                        </Link>
                        <Link
                            className="facebookicon"
                            title="Facebook"
                            href="#"
                        >
                            <i className="fab fa-facebook-f"></i>
                            <span className="mobiletext02">Facebook</span>
                        </Link>
                    </div>
                </div>
            </div>
            <div className="wsmainfull menu clearfix">
                <div className="wsmainwp clearfix">
                    <div className="desktoplogo">
                        <Link href="#hero-1">
                            <img
                                src={
                                    imageLink
                                        ? imageLink
                                        : "images/logo-grey.png"
                                }
                                width="180"
                                height="40"
                                alt="header-logo"
                            ></img>
                        </Link>
                    </div>

                    <nav className="wsmenu clearfix">
                        <ul className="wsmenu-list">
                            <li className="nl-simple" aria-haspopup="true">
                                <Link href={route("home")}>Home</Link>
                            </li>
                            <li className="nl-simple" aria-haspopup="true">
                                <Link href={route("history")}>Riwayat</Link>
                            </li>
                            <li className="nl-simple" aria-haspopup="true">
                                <Link href={route("data")}>Data</Link>
                            </li>
                            <li className="nl-simple" aria-haspopup="true">
                                <Link href={route("diagnosis")}>Diagnosis</Link>
                            </li>

                            <li
                                className="nl-simple header-btn"
                                aria-haspopup="true"
                            >
                                <Link href={route("login")}>
                                    {user ? "Dashboard" : "Login"}
                                </Link>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
    );
}
