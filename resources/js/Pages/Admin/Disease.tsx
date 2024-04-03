import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Link, Head } from "@inertiajs/react";
import { PageProps } from "@/types";

export default function Disease({ auth, isAdmin }: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Data Penyakit
                </h2>
            }
            isAdmin={isAdmin}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg row p-6">
                        <div className="col">
                            <h2 className="text-gray-900">Data Penyakit</h2>
                        </div>
                        <div className="col d-flex justify-content-end">
                            <Link
                                className="btn btn-primary align-items-center d-flex"
                                href={route("admin.disease.create")}
                            >
                                Tambah Data Penyakit
                            </Link>
                        </div>
                        <div className="col-12">
                            <p>Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
