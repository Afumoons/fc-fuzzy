import { Link, Head, useForm } from "@inertiajs/react";
import { PageProps } from "@/types";
import HomeLayout from "@/Layouts/HomeLayout";
import { FormEventHandler } from "react";
import PrimaryButton from "@/Components/Front/PrimaryButton";
import BreadCrumb from "@/Components/Front/BreadCrumb";
import RadioInput from "@/Components/RadioInput";

export default function Fuzzying2({
    auth,
    isAdmin,
    symptom,
    logoLink,
    footerLogoLink,
    statements,
}: PageProps<{
    laravelVersion: string;
    phpVersion: string;
    logoLink?: string;
    footerLogoLink?: string;
}>) {
    const { data, setData, post, processing, errors, reset } = useForm({
        value: "true",
        symptom_id: symptom.id,
    });

    const submit: FormEventHandler = (e) => {
        e.preventDefault();

        post(route("fuzzying.post"));
    };

    const updateFormData = (e: any, value: string) => {
        data.value = value;
        setData("symptom_id", symptom.id);
    };

    return (
        <HomeLayout
            user={auth.user}
            isAdmin={isAdmin}
            logoLink={logoLink}
            footerLogoLink={footerLogoLink}
        >
            <Head>
                <title>Fuzzy</title>
            </Head>

            <BreadCrumb
                title="Fuzzy"
                subtitle="Pembobotan Fuzzy"
                link={route("diagnosis")}
            />

            <div
                id="single-blog-page"
                className="py-12 blog-page-section division"
            >
                <div className="container">
                    <h3 className="h4-lg steelblue-color mb-5 text-center">
                        Pembobotan Fuzzy
                    </h3>
                    <form
                        onSubmit={submit}
                        className="card card-body shadow p-5 flex-column align-items-center "
                    >
                        <h3 className="text-center">
                            {symptom.id} - {symptom.code} - {symptom.name} ?
                        </h3>
                        <div className="row my-5 w-100">
                            {statements.map((statement, index) => (
                                <div
                                    className="d-flex justify-content-center"
                                    style={{ flex: 1 }}
                                    key={statement}
                                >
                                    <RadioInput
                                        id={"Radio" + index}
                                        type="radio"
                                        name="value"
                                        label={statement}
                                        isFocused={false}
                                        defaultChecked={false}
                                        onChange={(e) =>
                                            updateFormData(e, statement)
                                        }
                                        required
                                    />
                                </div>
                            ))}
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
