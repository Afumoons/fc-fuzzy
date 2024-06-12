import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { FormEventHandler } from "react";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Create({ auth, isAdmin, fuzzyRule, logo }: PageProps) {
    const { data, setData, post, processing, errors, reset } = useForm({
        result: fuzzyRule.data.consequent.TingkatKeparahan,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("admin.fuzzy.update", { fuzzyRule }));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Data Fuzzy Rule
                </h2>
            }
            isAdmin={isAdmin}
            logo={logo}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <h3>Pilihan</h3>
                        <ul>
                            {Object.entries(fuzzyRule.data.antecedent).map(
                                ([key, value]) => (
                                    <li>
                                        {key}
                                        {value}
                                    </li>
                                )
                            )}
                        </ul>
                        <form onSubmit={submit}>
                            <div>
                                <InputLabel htmlFor="result" value="Hasil" />

                                <TextInput
                                    id="result"
                                    name="result"
                                    value={data.result}
                                    className="mt-1 block w-full"
                                    type="number"
                                    max={90}
                                    min={30}
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData("result", e.target.value)
                                    }
                                    required
                                />

                                <InputError
                                    message={errors.result}
                                    className="mt-2"
                                />
                            </div>

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
