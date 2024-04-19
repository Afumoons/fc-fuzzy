import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import { PageProps } from "@/types";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faPenToSquare } from "@fortawesome/free-regular-svg-icons";

export default function Index({
    auth,
    isAdmin,
    logo,
    diseases,
    symptoms,
}: PageProps) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Data Rulebase
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
                            <h2 className="text-gray-900">Data Rulebase</h2>
                        </div>

                        <div className="mt-3 col-12 table-responsive">
                            <table className="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">NO</th>
                                        <th scope="col" className="min-w-40">
                                            Penyakit
                                        </th>
                                        {symptoms.map((symptom) => (
                                            <th key={symptom.id}>
                                                {symptom.code}
                                            </th>
                                        ))}
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {/* foreach disease */}
                                    {diseases.map((disease, diseaseKey) => (
                                        <tr key={disease.id}>
                                            <td>{diseaseKey + 1}</td>
                                            <td>
                                                {"(" +
                                                    disease.code +
                                                    ") " +
                                                    disease.name}
                                            </td>
                                            {/* foreach symptom */}
                                            {symptoms.map(
                                                (symptom, symptomKey) => (
                                                    <td key={symptom.id}>
                                                        {disease.rulebases[
                                                            symptomKey
                                                        ]
                                                            ? disease.rulebases[
                                                                  symptomKey
                                                              ].value
                                                                ? "Ya"
                                                                : "Tidak"
                                                            : "-"}
                                                    </td>
                                                )
                                            )}
                                            <td className="min-w-20">
                                                <Link
                                                    href={route(
                                                        "admin.rulebase.edit",
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
