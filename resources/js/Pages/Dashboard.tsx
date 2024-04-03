import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import DashboardCard from "@/Components/DashboardCard";

export default function Dashboard({
    auth,
    isAdmin,
    dashboardCounts,
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
                        <div className="row mb-3 p-3">
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
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
