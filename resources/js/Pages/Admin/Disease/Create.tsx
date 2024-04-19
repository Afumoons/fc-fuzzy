import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import InputLabel from "@/Components/InputLabel";
import TextInput from "@/Components/TextInput";
import { FormEventHandler } from "react";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";

export default function Create({ auth, isAdmin, logo }: PageProps) {
    const { data, setData, post, processing, errors, reset } = useForm({
        code: "",
        name: "",
        cause: "",
        solution: "",
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("admin.disease.store"));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Tambah Data Penyakit
                </h2>
            }
            isAdmin={isAdmin}
            logo={logo}
        >
            <Head title="Dashboard" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                        <form onSubmit={submit}>
                            <div>
                                <InputLabel htmlFor="code" value="Kode" />

                                <TextInput
                                    id="code"
                                    name="code"
                                    value={data.code}
                                    className="mt-1 block w-full"
                                    isFocused={true}
                                    onChange={(e) =>
                                        setData("code", e.target.value)
                                    }
                                    required
                                />

                                <InputError
                                    message={errors.code}
                                    className="mt-2"
                                />
                            </div>

                            <div className="mt-4">
                                <InputLabel htmlFor="name" value="Nama" />

                                <TextInput
                                    id="name"
                                    type="text"
                                    name="name"
                                    value={data.name}
                                    className="mt-1 block w-full"
                                    onChange={(e) =>
                                        setData("name", e.target.value)
                                    }
                                    required
                                />

                                <InputError
                                    message={errors.name}
                                    className="mt-2"
                                />
                            </div>

                            <div className="mt-4">
                                <InputLabel htmlFor="cause" value="Penyebab" />

                                <TextInput
                                    id="cause"
                                    type="text"
                                    name="cause"
                                    value={data.cause}
                                    className="mt-1 block w-full"
                                    onChange={(e) =>
                                        setData("cause", e.target.value)
                                    }
                                    required
                                />

                                <InputError
                                    message={errors.cause}
                                    className="mt-2"
                                />
                            </div>

                            <div className="mt-4">
                                <InputLabel
                                    htmlFor="solution"
                                    value="Solusi Pertolongan Pertama"
                                />

                                <TextInput
                                    id="solution"
                                    type="text"
                                    name="solution"
                                    value={data.solution}
                                    className="mt-1 block w-full"
                                    autoComplete="new-password"
                                    onChange={(e) =>
                                        setData("solution", e.target.value)
                                    }
                                    required
                                />

                                <InputError
                                    message={errors.solution}
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
