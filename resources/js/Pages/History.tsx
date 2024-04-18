import { Link, Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import HomeLayout from "@/Layouts/HomeLayout";
import BreadCrumb from "@/Components/Front/BreadCrumb";

export default function History({
    auth,
    isAdmin,
    rulebaseHistorys,
}: PageProps<{
    laravelVersion: string;
    phpVersion: string;
}>) {
    return (
        <HomeLayout user={auth.user} isAdmin={isAdmin}>
            <Head>
                <title>Data</title>
            </Head>

            <BreadCrumb
                title="Riwayat"
                subtitle="Riwayat Diagnosis"
                link={route("history")}
            />

            <div
                id="single-blog-page"
                className="py-12 blog-page-section division"
            >
                <div className="container">
                    <h3 className="h4-lg steelblue-color mb-2 text-center">
                        Hasil Diagnosis
                    </h3>
                    <h5 className="text-center">
                        Hasil Diagnosis Penyakit Kulit dengan metode forward
                        chaining.
                    </h5>
                    <div className="card card-body">
                        <table className="table table-hover table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Penyakit</th>
                                    <th>Lihat</th>
                                </tr>
                            </thead>
                            <tbody>
                                {rulebaseHistorys.map(
                                    (rulebaseHistory, index) => (
                                        <tr key={rulebaseHistory.id}>
                                            <td>{index + 1}</td>
                                            <td>{rulebaseHistory.user.name}</td>
                                            <td>
                                                {rulebaseHistory.user.email}
                                            </td>
                                            <td>
                                                {rulebaseHistory.disease
                                                    ? rulebaseHistory.disease
                                                          .name
                                                    : "Tidak ditemukan"}
                                            </td>
                                            <td>
                                                <Link
                                                    href={route(
                                                        "diagnosisResult",
                                                        [rulebaseHistory]
                                                    )}
                                                    className="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                                >
                                                    Lihat
                                                </Link>
                                            </td>
                                        </tr>
                                    )
                                )}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
