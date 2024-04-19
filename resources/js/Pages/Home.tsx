import { Link, Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import HomeLayout from "@/Layouts/HomeLayout";

export default function Home({
    auth,
    isAdmin,
    laravelVersion,
    phpVersion,
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {
    return (
        <HomeLayout user={auth.user} isAdmin={isAdmin} loading={true}>
            <Head>
                <title>Beranda</title>
            </Head>

            <section id="hero-1" className="bg-fixed hero-section division">
                <div className="container">
                    <div className="row d-flex align-items-center">
                        <div className="col-md-8 col-lg-7 col-xl-6">
                            <div className="hero-txt mb-40">
                                <h5 className="steelblue-color">
                                    Pra Diagnosis Penyakit Kulit
                                </h5>
                                <h2 className="steelblue-color">
                                    Diagnosis Mandiri
                                </h2>

                                <p className="p-md">
                                    Secara mudah pra-diagnosis secara mandiri
                                    sehingga pertolongan pertama dapat dilakukan
                                    secepatnya
                                </p>

                                <Link
                                    href={route("diagnosis")}
                                    className="btn btn-blue blue-hover"
                                >
                                    Diagnosis Sekarang
                                </Link>
                            </div>
                        </div>

                        <div className="col-md-4 col-lg-5 col-xl-6">
                            <div className="hero-1-img text-center">
                                <img
                                    className="img-fluid"
                                    src="images/header3.jpg"
                                    alt="hero-image"
                                ></img>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="about-1" className="about-section division">
                <div className="container">
                    <div className="row d-flex align-items-center">
                        <div id="abox-1" className="col-md-6 col-lg-3">
                            <div className="abox-1 white-color">
                                <h5 className="h5-md">Working Time</h5>

                                <table className="table white-color">
                                    <tbody>
                                        <tr>
                                            <td>Mon – Wed</td>
                                            <td> - </td>
                                            <td className="text-right">
                                                9:00 AM - 7:00 PM
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Thursday</td>
                                            <td> - </td>
                                            <td className="text-right">
                                                9:00 AM - 6:30 PM
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Friday</td>
                                            <td> - </td>
                                            <td className="text-right">
                                                9:00 AM - 6:00 PM
                                            </td>
                                        </tr>
                                        <tr className="last-tr">
                                            <td>Sun - Sun</td>
                                            <td>-</td>
                                            <td className="text-right">
                                                CLOSED
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="abox-2" className="col-md-6 col-lg-3">
                            <div className="abox-1 white-color">
                                <h5 className="h5-md">Kenalan Pembuat</h5>

                                <p>
                                    Adalah seorang mahasiswa UPN "Veteran" Jawa
                                    Timur
                                </p>

                                <Link
                                    href={route("github")}
                                    className="btn btn-sm btn-tra-white mt-25"
                                >
                                    Lihat Profil Github
                                </Link>
                            </div>
                        </div>

                        <div id="abox-3" className="col-md-6 col-lg-3">
                            <div className="abox-1 white-color">
                                <h5 className="h5-md">Diagnosis</h5>

                                <p>
                                    Aplikasi ini dirancang untuk mendiagnosis
                                    beberapa penyakit kulit yang sering dialami
                                    masyarakat
                                </p>

                                <Link
                                    href={route("diagnosis")}
                                    className="btn btn-sm btn-tra-white mt-25"
                                >
                                    Diagnosis Sekarang
                                </Link>
                            </div>
                        </div>

                        <div id="abox-4" className="col-md-6 col-lg-3">
                            <div className="abox-1 white-color">
                                <h5 className="h5-md">Hubungi Kami</h5>

                                <h5 className="h5-lg emergency-call">
                                    <i className="fas fa-phone"></i>{" "}
                                    <Link
                                        className="text-decoration-none"
                                        href={route("whatsapp")}
                                    >
                                        +6287744554566
                                    </Link>
                                </h5>
                                {/* <p className="mt-20">
                                    Hubungi Pembuat Aplikasi ini
                                </p> */}
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {/* <section id="info-2" className="wide-60 info-section division">
                <div className="container">
                    <div className="row d-flex align-items-center">
                        <div className="col-lg-6">
                            <div
                                className="txt-block pc-30 mb-40 wow fadeInUp"
                                data-wow-delay="0.4s"
                            >
                                <span className="section-id blue-color">
                                    Best Practices
                                </span>

                                <h3 className="h3-md steelblue-color">
                                    Clinic with Innovative Approach to Treatment
                                </h3>

                                <p className="mb-30">
                                    An enim nullam tempor sapien gravida donec
                                    enim ipsum blandit porta justo integer odio
                                    velna vitae auctor integer congue magna at
                                    pretium purus pretium ligula rutrum itae
                                    laoreet augue posuere and curae integer
                                    congue leo metus mollis primis and mauris
                                </p>

                                <div className="row">
                                    <div className="col-xl-6">
                                        <div className="box-list m-top-15">
                                            <div className="box-list-icon blue-color">
                                                <i className="fas fa-angle-double-right"></i>
                                            </div>
                                            <p className="p-sm">
                                                Nemo ipsam egestas volute and
                                                turpis dolores quaerat
                                            </p>
                                        </div>

                                        <div className="box-list">
                                            <div className="box-list-icon blue-color">
                                                <i className="fas fa-angle-double-right"></i>
                                            </div>
                                            <p className="p-sm">
                                                Magna luctus tempor
                                            </p>
                                        </div>

                                        <div className="box-list">
                                            <div className="box-list-icon blue-color">
                                                <i className="fas fa-angle-double-right"></i>
                                            </div>
                                            <p className="p-sm">
                                                An enim nullam tempor at pretium
                                                purus blandit
                                            </p>
                                        </div>
                                    </div>

                                    <div className="col-xl-6">
                                        <div className="box-list">
                                            <div className="box-list-icon blue-color">
                                                <i className="fas fa-angle-double-right"></i>
                                            </div>
                                            <p className="p-sm">
                                                Magna luctus tempor blandit a
                                                vitae suscipit mollis
                                            </p>
                                        </div>

                                        <div className="box-list m-top-15">
                                            <div className="box-list-icon blue-color">
                                                <i className="fas fa-angle-double-right"></i>
                                            </div>
                                            <p className="p-sm">
                                                Nemo ipsam egestas volute turpis
                                                dolores quaerat
                                            </p>
                                        </div>

                                        <div className="box-list">
                                            <div className="box-list-icon blue-color">
                                                <i className="fas fa-angle-double-right"></i>
                                            </div>
                                            <p className="p-sm">
                                                An enim nullam tempor
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="col-lg-6">
                            <div
                                className="info-2-img wow fadeInUp"
                                data-wow-delay="0.6s"
                            >
                                <img
                                    className="img-fluid"
                                    src="images/image-04.png"
                                    alt="info-image"
                                ></img>
                            </div>
                        </div>
                    </div>
                </div>
            </section> */}
        </HomeLayout>
    );
}
