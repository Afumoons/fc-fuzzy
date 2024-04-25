import { Link, Head, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import HomeLayout from "@/Layouts/HomeLayout";
import { FormEventHandler } from "react";
import PrimaryButton from "@/Components/Front/PrimaryButton";
import BreadCrumb from "@/Components/Front/BreadCrumb";
import RadioInput from "@/Components/RadioInput";

export default function Fuzzy({
    auth,
    isAdmin,
    disease,
    fuzzyUserInputs,
    logoLink,
    footerLogoLink,
    fuzzyResult,
}: PageProps<{
    laravelVersion: string;
    phpVersion: string;
    logoLink?: string;
    footerLogoLink?: string;
    fuzzyResult?: string;
}>) {
    return (
        <HomeLayout
            user={auth.user}
            isAdmin={isAdmin}
            logoLink={logoLink}
            footerLogoLink={footerLogoLink}
        >
            <Head>
                <title>Data</title>
            </Head>

            <BreadCrumb
                title="Pembobotan"
                subtitle="Hasil Pembobotan Penyakit"
                link={route("diagnosis")}
            />

            <div
                id="single-blog-page"
                className="py-12 blog-page-section division"
            >
                <div className="container">
                    <h3 className="h4-lg steelblue-color mb-2 text-center">
                        Hasil Pembobotan
                    </h3>
                    <h5 className="text-center">
                        Hasil Pembobotan Penyakit Kulit dengan fuzzy sugeno.
                    </h5>
                    <div className="card card-body">
                        <table className="table table-bordered table-striped">
                            <tr>
                                <td>
                                    <p className="font-bold">Nama Pengguna</p>
                                </td>
                                <td>{auth.user.name}</td>
                            </tr>
                            <tr>
                                <td>
                                    <p className="font-bold">Email Pengguna</p>
                                </td>
                                <td>{auth.user.email}</td>
                            </tr>
                            <tr>
                                <td>
                                    <p className="font-bold">
                                        Jawaban Pengguna
                                    </p>
                                </td>
                                <td>
                                    <ul>
                                        {fuzzyUserInputs.map(
                                            (fuzzyUserInput) => (
                                                <li
                                                    key={fuzzyUserInput.id}
                                                    className="list-group-item"
                                                >
                                                    {
                                                        fuzzyUserInput.symptom
                                                            .code
                                                    }{" "}
                                                    -{" "}
                                                    {
                                                        fuzzyUserInput.symptom
                                                            .name
                                                    }
                                                    {" ("}
                                                    {fuzzyUserInput.value}
                                                    {")"}
                                                </li>
                                            )
                                        )}
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p className="font-bold">Hasil</p>
                                </td>
                                <td>
                                    {"Anda kemungkinan menderita "}
                                    {disease
                                        ? disease.code + " - " + disease.name
                                        : "Penyakit tidak ditemukan"}
                                    {" sebesar "}
                                    {fuzzyResult}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p className="font-bold">
                                        Penyebab Penyakit
                                    </p>
                                </td>
                                <td>{disease ? disease.cause : "-"}</td>
                            </tr>
                            <tr>
                                <td>
                                    <p className="font-bold">
                                        Solusi Pertolongan Pertama
                                    </p>
                                </td>
                                <td>{disease ? disease.solution : "-"}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
