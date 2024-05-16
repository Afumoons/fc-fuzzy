import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { PageProps } from "@/types";
import DashboardCard from "@/Components/DashboardCard";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEye, faTrashCan } from "@fortawesome/free-regular-svg-icons";

export default function Dashboard({
    auth,
    isAdmin,
    dashboardCounts,
    rulebaseHistories,
    logo,
}: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Dashboard
                </h2>
            }
            isAdmin={isAdmin}
            logo={logo}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                        <div className="row">
                            <DashboardCard
                                color="primary"
                                count={dashboardCounts.symptomsCount}
                                text="Jumlah Gejala"
                            />
                            <DashboardCard
                                color="info"
                                count={dashboardCounts.diseasesCount}
                                text="Jumlah Penyakit"
                            />
                            <DashboardCard
                                color="warning"
                                count={dashboardCounts.usersCount}
                                text="Jumlah Pengguna"
                            />
                            <DashboardCard
                                color="danger"
                                count={dashboardCounts.adminsCount}
                                text="Jumlah Admin"
                            />
                        </div>
                        <h4 className="mt-4 mb-2">Data Riwayat Diagnosis</h4>
                        <div className="row table-responsive">
                            <table className="table table-bordered table-hover table-striped">
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
                                    {rulebaseHistories.map(
                                        (rulebaseHistory, index) => (
                                            <tr key={rulebaseHistory.id}>
                                                <td>{index + 1}</td>
                                                <td>
                                                    {rulebaseHistory.user.name}
                                                </td>
                                                <td>
                                                    {rulebaseHistory.user.email}
                                                </td>
                                                <td>
                                                    {rulebaseHistory.disease
                                                        ? rulebaseHistory
                                                              .disease.name
                                                        : "Tidak ditemukan"}
                                                </td>
                                                <td>
                                                    <div className="flex justify-around">
                                                        <Link
                                                            href={route(
                                                                "diagnosisResult",
                                                                [
                                                                    rulebaseHistory,
                                                                ]
                                                            )}
                                                            className="badge bg-primary text-decoration-none p-2"
                                                        >
                                                            <FontAwesomeIcon
                                                                icon={faEye}
                                                            />
                                                        </Link>
                                                        <Link
                                                            href={route(
                                                                "admin.rulebaseHistory.destroy",
                                                                {
                                                                    rulebaseHistory,
                                                                }
                                                            )}
                                                            className="badge bg-danger text-decoration-none p-2"
                                                        >
                                                            <FontAwesomeIcon
                                                                icon={
                                                                    faTrashCan
                                                                }
                                                            />
                                                        </Link>
                                                    </div>
                                                </td>
                                            </tr>
                                        )
                                    )}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
