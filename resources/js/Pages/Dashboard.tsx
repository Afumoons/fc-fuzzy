import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { PageProps } from "@/types";
import DashboardCard from "@/Components/DashboardCard";

export default function Dashboard({
    auth,
    isAdmin,
    dashboardCounts,
    rulebaseHistorys,
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
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="row p-3">
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
                        <div className="row p-4 table-responsive">
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
                                    {rulebaseHistorys.map(
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
            </div>
        </AuthenticatedLayout>
    );
}
