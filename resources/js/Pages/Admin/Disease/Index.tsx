import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Link, Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPenToSquare, faTrashCan } from "@fortawesome/free-regular-svg-icons";

export default function Index({ auth, isAdmin, diseases, logo }: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Data Penyakit
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
                        <div className="mt-3 col-12 table-responsive">
                            <table className="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Penyebab</th>
                                        <th scope="col">
                                            Solusi Pertolongan Pertama
                                        </th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {diseases.map((disease, key) => (
                                        <tr key={disease.id}>
                                            <td>{key + 1}</td>
                                            <td>{disease.code}</td>
                                            <td>{disease.name}</td>
                                            <td>{disease.cause}</td>
                                            <td>{disease.solution}</td>
                                            <td className="min-w-20">
                                                <Link
                                                    href={route(
                                                        "admin.disease.edit",
                                                        { disease }
                                                    )}
                                                    className="mr-2 badge bg-warning text-decoration-none p-2"
                                                >
                                                    <FontAwesomeIcon
                                                        icon={faPenToSquare}
                                                    />
                                                </Link>
                                                <Link
                                                    href={route(
                                                        "admin.disease.destroy",
                                                        { disease }
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
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
