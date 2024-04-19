import { Link } from "@inertiajs/react";

interface FrontFooterProps {
    imageLink?: string;
}

export default function FrontFooter({ imageLink, ...props }: FrontFooterProps) {
    return (
        <footer id="footer-1" className="wide-40 footer division">
            <div className="container">
                <div className="row">
                    <div className="col-md-6 col-lg-3">
                        <div className="footer-info mb-40">
                            <img
                                src={
                                    imageLink
                                        ? imageLink
                                        : "images/footer-logo.png"
                                }
                                width="180"
                                height="40"
                                alt="footer-logo"
                            ></img>

                            <p className="p-sm mt-20">
                                Aplikasi Pra Diagnosis Penyakit Kulit
                                Menggunakan Forward Chaining dan Fuzzy
                            </p>

                            <div className="footer-socials-links mt-20">
                                <ul className="foo-socials text-center clearfix">
                                    <li>
                                        <Link href="#" className="ico-facebook">
                                            <i className="fab fa-facebook-f"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-twitter">
                                            <i className="fab fa-twitter"></i>
                                        </Link>
                                    </li>
                                    {/* <li>
                                        <Link
                                            href="#"
                                            className="ico-google-plus"
                                        >
                                            <i className="fab fa-google-plus-g"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-tumblr">
                                            <i className="fab fa-tumblr"></i>
                                        </Link>
                                    </li>

                                    <li>
                                        <Link href="#" className="ico-behance">
                                            <i className="fab fa-behance"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-dribbble">
                                            <i className="fab fa-dribbble"></i>
                                        </Link>
                                    </li> */}
                                    <li>
                                        <Link
                                            href="#"
                                            className="ico-instagram"
                                        >
                                            <i className="fab fa-instagram"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-linkedin">
                                            <i className="fab fa-linkedin-in"></i>
                                        </Link>
                                    </li>
                                    {/* <li>
                                        <Link
                                            href="#"
                                            className="ico-pinterest"
                                        >
                                            <i className="fab fa-pinterest-p"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-youtube">
                                            <i className="fab fa-youtube"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-vk">
                                            <i className="fab fa-vk"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-yelp">
                                            <i className="fab fa-yelp"></i>
                                        </Link>
                                    </li>
                                    <li>
                                        <Link href="#" className="ico-yahoo">
                                            <i className="fab fa-yahoo"></i>
                                        </Link>
                                    </li> */}
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div className="col-md-6 col-lg-3">
                        <div className="footer-box mb-40">
                            <h5 className="h5-xs">Lokasi Kami</h5>

                            <p>UPN "Veteran" Jawa Timur</p>

                            <p className="foo-email mt-20">
                                E:{" "}
                                <Link
                                    className="text-decoration-none"
                                    href={route("mail")}
                                >
                                    afumoons@gmail.com
                                </Link>
                            </p>

                            <p>
                                P:{" "}
                                <Link
                                    className="text-decoration-none"
                                    href={route("whatsapp")}
                                >
                                    087744554566
                                </Link>
                            </p>
                        </div>
                    </div>

                    <div className="col-md-6 col-lg-3">
                        <div className="footer-box mb-40">
                            <h5 className="h5-xs">Jam Kerja</h5>

                            <p className="p-sm">
                                Sen - Rab - <span>9:00 AM - 7:00 PM</span>
                            </p>
                            <p className="p-sm">
                                Kamis - <span>9:00 AM - 6:30 PM</span>
                            </p>
                            <p className="p-sm">
                                Jumat - <span>9:00 AM - 6:00 PM</span>
                            </p>
                            <p className="p-sm">
                                Sab - Ming - <span>Tutup</span>
                            </p>
                        </div>
                    </div>

                    <div className="col-md-6 col-lg-3">
                        <div className="footer-box mb-40">
                            <h5 className="h5-xs">Hubungi Kami</h5>

                            <h5 className="h5-xl blue-color">
                                <Link
                                    className="text-decoration-none"
                                    href={route("whatsapp")}
                                >
                                    +6287744554566
                                </Link>
                            </h5>

                            {/* <p className="p-sm mt-15">
                                Aliquam orci nullam undo tempor sapien gravida
                                donec enim ipsum porta justo velna aucto magna
                            </p> */}
                        </div>
                    </div>
                </div>

                <div className="bottom-footer">
                    <div className="row">
                        <div className="col-md-12">
                            <p className="footer-copyright">
                                &copy; 2024{" "}
                                <span>
                                    <Link
                                        className="text-decoration-none"
                                        href={route("github")}
                                    >
                                        Afumoons
                                    </Link>
                                </span>
                                . All Rights Reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    );
}
