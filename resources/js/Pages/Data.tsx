import { Link, Head } from "@inertiajs/react";
import { PageProps } from "@/types";
import HomeLayout from "@/Layouts/HomeLayout";
import BreadCrumb from "@/Components/Front/BreadCrumb";

export default function Data({
    auth,
    isAdmin,
    symptoms,
    diseases,
    rulebases,
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {
    return (
        <HomeLayout user={auth.user} isAdmin={isAdmin}>
            <Head>
                <title>Data</title>
            </Head>

            <BreadCrumb
                title="Data"
                subtitle="Data Pakar"
                link={route("data")}
            />

            <div
                id="single-blog-page"
                className="wide-100 blog-page-section division"
            >
                <div className="container">
                    <h4 className="h4-lg steelblue-color">Data Pakar</h4>

                    <h5 className="h5-md steelblue-color my-7">Data Gejala</h5>
                    <table className="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td className="font-bold">No</td>
                                <td className="font-bold">Inisial</td>
                                <td className="font-bold">Nama Gejala</td>
                            </tr>
                        </thead>
                        <tbody>
                            {symptoms.map((symptom, key) => (
                                <tr key={symptom.id}>
                                    <td>{key + 1}</td>
                                    <td>{symptom.code}</td>
                                    <td>{symptom.name}</td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    <h5 className="h5-md steelblue-color my-7 mt-14">
                        Data Penyakit
                    </h5>
                    <table className="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td className="font-bold">No</td>
                                <td className="font-bold">Inisial</td>
                                <td className="font-bold">Nama Penyakit</td>
                                <td className="font-bold">Penyebab</td>
                                <td className="font-bold">Solusi</td>
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
                                </tr>
                            ))}
                        </tbody>
                    </table>
                    <h5 className="h5-md steelblue-color my-7 mt-14">
                        Data Relasi
                    </h5>
                    <p className="text-dark">
                        Data relasi antara Penyakit dan gejala.
                    </p>
                    <div className="overflow-auto">
                        <table className="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td className="font-bold">No</td>
                                    <th scope="col" className="min-w-40">
                                        Penyakit
                                    </th>
                                    {symptoms.map((symptom) => (
                                        <th key={symptom.id}>{symptom.code}</th>
                                    ))}
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
                                        {symptoms.map((symptom, symptomKey) => (
                                            <td key={symptom.id}>
                                                {disease.rulebases[symptomKey]
                                                    ? disease.rulebases[
                                                          symptomKey
                                                      ].value
                                                        ? "Ya"
                                                        : "Tidak"
                                                    : "-"}
                                            </td>
                                        ))}
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
