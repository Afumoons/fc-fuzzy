import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps, Rulebase } from "@/types";
import { FormEventHandler } from "react";
import * as React from "react";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import FormGroup from "@mui/material/FormGroup";
import FormControlLabel from "@mui/material/FormControlLabel";
import Checkbox from "@mui/material/Checkbox";

export default function Create({
    auth,
    isAdmin,
    disease,
    symptoms,
}: PageProps) {
    const { data, setData, post, processing, errors, reset } = useForm({
        rulebases: disease.rulebases,
        // code: disease.code,
        // name: disease.name,
        // cause: disease.cause,
        // solution: disease.solution,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("admin.rulebase.update", { disease }));
    };

    const updateRulebases = (
        symptomIndex: number,
        disease_id: number,
        symptom_id: number,
        value: any,
        e: any
    ) => {
        const newRulebases = [...data.rulebases];
        newRulebases[symptomIndex] = {
            ...newRulebases[symptomIndex],
            disease_id,
            symptom_id,
            value,
        };
        setData("rulebases", newRulebases);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Relasi/ Rulebase
                </h2>
            }
            isAdmin={isAdmin}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <form onSubmit={submit}>
                            <table className="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th className="w-25">Kriteria</th>
                                        <th>
                                            ({disease.code}) {disease.name}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {symptoms.map((symptom, symptomIndex) => (
                                        <tr key={symptom.id}>
                                            <td>
                                                {symptom.code}
                                                <br />
                                                <p className="text-muted">
                                                    {symptom.name}
                                                </p>
                                            </td>
                                            <td>
                                                <FormGroup>
                                                    <FormControlLabel
                                                        control={
                                                            <Checkbox
                                                                value={true}
                                                                defaultChecked={
                                                                    disease
                                                                        .rulebases[
                                                                        symptomIndex
                                                                    ]
                                                                        ? disease
                                                                              .rulebases[
                                                                              symptomIndex
                                                                          ]
                                                                              .value
                                                                        : false
                                                                }
                                                                // checked={
                                                                //     checked
                                                                // }
                                                                onChange={(e) =>
                                                                    updateRulebases(
                                                                        symptomIndex,
                                                                        disease.id,
                                                                        symptom.id,
                                                                        e.target
                                                                            .checked
                                                                            ? "true"
                                                                            : "false",
                                                                        e
                                                                    )
                                                                }
                                                                inputProps={{
                                                                    "aria-label":
                                                                        "controlled",
                                                                }}
                                                            />
                                                        }
                                                        label="Ya"
                                                    />
                                                </FormGroup>
                                                <InputError
                                                    message={errors.rulebases}
                                                    className="mt-2"
                                                />
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>

                            <div className="flex items-center justify-end mt-4">
                                <PrimaryButton
                                    className="ms-4"
                                    disabled={processing}
                                >
                                    Simpan
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
