import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { PageProps } from "@/types";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPenToSquare, faTrashCan } from "@fortawesome/free-regular-svg-icons";

export default function Index({ auth, isAdmin, symptoms, logo }: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Data Gejala
                </h2>
            }
            isAdmin={isAdmin}
            logo={logo}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg row p-6">
                        <div className="col">
                            <h2 className="text-gray-900">Data Gejala</h2>
                        </div>
                        <div className="col d-flex justify-content-end">
                            <Link
                                className="btn btn-primary align-items-center d-flex"
                                href={route("admin.symptom.create")}
                            >
                                Tambah Data Gejala
                            </Link>
                        </div>
                        {symptoms[0] ? (
                            <div className="mt-3 col-12 table-responsive">
                                <table className="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">NO</th>
                                            <th scope="col">Kode</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Opsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {symptoms.map((symptom, key) => (
                                            <tr key={symptom.id}>
                                                <td>{key + 1}</td>
                                                <td>{symptom.code}</td>
                                                <td>{symptom.name}</td>
                                                <td className="min-w-20">
                                                    <Link
                                                        href={route(
                                                            "admin.symptom.edit",
                                                            { symptom }
                                                        )}
                                                        className="mr-2 badge bg-warning text-decoration-none p-2"
                                                    >
                                                        <FontAwesomeIcon
                                                            icon={faPenToSquare}
                                                        />
                                                    </Link>
                                                    <Link
                                                        href={route(
                                                            "admin.symptom.destroy",
                                                            { symptom }
                                                        )}
                                                        className="badge bg-danger text-decoration-none p-2"
                                                    >
                                                        <FontAwesomeIcon
                                                            icon={faTrashCan}
                                                        />
                                                    </Link>
                                                </td>
                                            </tr>
                                        ))}
                                    </tbody>
                                </table>
                            </div>
                        ) : (
                            <p className="mt-5 text-center">
                                Belum ada data gejala
                            </p>
                        )}
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
