import { Link, Head, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import HomeLayout from "@/Layouts/HomeLayout";
import { FormEventHandler } from "react";
import PrimaryButton from "@/Components/Front/PrimaryButton";
import BreadCrumb from "@/Components/Front/BreadCrumb";
import RadioInput from "@/Components/RadioInput";

export default function Diagnosing({
    auth,
    isAdmin,
    symptom,
}: PageProps<{ laravelVersion: string; phpVersion: string }>) {
    const { data, setData, post, processing, errors, reset } = useForm({
        value: "true",
        symptom_id: symptom.id,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("diagnosing.post2"));
    };

    const updateFormData = (e: any, type: boolean) => {
        if (type) {
            var value = e.target.checked ? "true" : "false";
        } else {
            var value = e.target.checked ? "false" : "true";
        }

        data.value = value;
        setData("symptom_id", symptom.id);
    };

    return (
        <HomeLayout user={auth.user} isAdmin={isAdmin}>
            <Head>
                <title>Data</title>
            </Head>

            <BreadCrumb
                title="Diagnosis"
                subtitle="Diagnosis Penyakit"
                link={route("diagnosis")}
            />

            <div
                id="single-blog-page"
                className="py-12 blog-page-section division"
            >
                <div className="container">
                    <h3 className="h4-lg steelblue-color mb-5 text-center">
                        Diagnosis
                    </h3>
                    <form
                        onSubmit={submit}
                        className="card card-body shadow p-5 flex-column align-items-center "
                    >
                        <h3 className="text-center">
                            {symptom.id} - {symptom.code} - {symptom.name} ?
                        </h3>
                        <div className="row my-5 w-100">
                            <div className="col-md-6 d-flex justify-content-center">
                                <RadioInput
                                    id="Radio1"
                                    type="radio"
                                    name="value"
                                    label="Ya"
                                    placeholder="Nama Lengkap"
                                    isFocused={false}
                                    defaultChecked={false}
                                    onChange={(e) => updateFormData(e, true)}
                                    required
                                />
                            </div>
                            <div className="col-md-6 d-flex justify-content-center">
                                <RadioInput
                                    id="Radio2"
                                    type="radio"
                                    name="value"
                                    label="Tidak"
                                    placeholder="Nama Lengkap"
                                    isFocused={false}
                                    defaultChecked={false}
                                    onChange={(e) => updateFormData(e, false)}
                                    required
                                />
                            </div>
                        </div>

                        <PrimaryButton type="submit" className="d-inline w-50">
                            Simpan Jawaban
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </HomeLayout>
    );
}
