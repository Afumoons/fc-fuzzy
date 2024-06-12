import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Link, Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPenToSquare } from "@fortawesome/free-regular-svg-icons";

export default function Index({ auth, isAdmin, diseases, logo }: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Data Rule Fuzzy
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
                            <h2 className="text-gray-900">Data Rule Fuzzy</h2>
                        </div>
                        {/* <div className="col d-flex justify-content-end">
                            <Link
                                className="btn btn-primary align-items-center d-flex"
                                href={route("admin.disease.create")}
                            >
                                Tambah Data Rule Fuzzy
                            </Link>
                        </div> */}
                        <div className="mt-3 col-12 table-responsive">
                            <table className="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col">Kode</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Jumlah Rule Fuzzy</th>
                                        <th scope="col">Lihat Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {diseases.map((disease, key) => (
                                        <tr key={disease.id}>
                                            <td>{key + 1}</td>
                                            <td>{disease.code}</td>
                                            <td>{disease.name}</td>
                                            <td>
                                                {disease.fuzzy_rules.length}
                                            </td>

                                            <td className="min-w-20">
                                                <Link
                                                    href={route(
                                                        "admin.fuzzy.show",
                                                        { disease }
                                                    )}
                                                    className="mr-2 badge bg-warning text-decoration-none p-2"
                                                >
                                                    <FontAwesomeIcon
                                                        icon={faPenToSquare}
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
