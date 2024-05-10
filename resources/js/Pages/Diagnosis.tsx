import { Link, Head, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import HomeLayout from "@/Layouts/HomeLayout";
import { FormEventHandler } from "react";
import PrimaryButton from "@/Components/Front/PrimaryButton";
import BreadCrumb from "@/Components/Front/BreadCrumb";
import RadioInput from "@/Components/RadioInput";

export default function Diagnosis({
    auth,
    isAdmin,
    disease,
    rulebaseUserInputs,
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
    console.log(fuzzyResult);

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
                title="Diagnosis"
                subtitle="Hasil Diagnosis Penyakit"
                link={route("diagnosis")}
            />

            <div
                id="single-blog-page"
                className="py-12 blog-page-section division"
            >
                <div className="container">
                    <h3 className="h4-lg steelblue-color mb-2 text-center">
                        Hasil Diagnosis
                    </h3>
                    <h5 className="text-center">
                        Hasil Diagnosis Penyakit Kulit dengan metode forward
                        chaining dan fuzzy.
                    </h5>
                    <div className="card card-body">
                        <table className="table table-bordered table-striped">
                            <tr>
                                <td>
                                    <p className="font-bold">
                                        Jawaban Pengguna
                                    </p>
                                </td>
                                <td>
                                    <h5>Diagnosis</h5>
                                    <ul>
                                        {rulebaseUserInputs.map(
                                            (rulebaseUserInput) => (
                                                <li
                                                    key={rulebaseUserInput.id}
                                                    className="list-group-item"
                                                >
                                                    {
                                                        rulebaseUserInput
                                                            .symptom.code
                                                    }{" "}
                                                    -{" "}
                                                    {
                                                        rulebaseUserInput
                                                            .symptom.name
                                                    }{" "}
                                                    {rulebaseUserInput.value
                                                        ? "-> (benar - ya)"
                                                        : "-> (salah - tidak)"}
                                                </li>
                                            )
                                        )}
                                    </ul>
                                    <h5 className="mt-3">Pembobotan</h5>
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
                                    {disease
                                        ? "Anda kemungkinan menderita " +
                                          disease.name +
                                          " sebesar " +
                                          fuzzyResult
                                        : "Penyakit tidak ditemukan"}
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
                            {/* <tr>
                                <td>
                                    <p className="font-bold">
                                        Tindakan Lanjutan
                                    </p>
                                </td>
                                <td>
                                    <p>
                                        Ketahui seberapa mungkin penyakit yang
                                        diderita dengan menggunakan fuzzy
                                    </p>
                                    <Link
                                        href={
                                            disease
                                                ? route("fuzzy", [disease.code])
                                                : "#"
                                        }
                                        className="d-block w-25 text-center inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-600 focus:bg-blue-600 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                                    >
                                        Cek sekarang
                                    </Link>
                                </td>
                            </tr> */}
                        </table>
                    </div>
                </div>
            </div>
        </HomeLayout>
    );
}
