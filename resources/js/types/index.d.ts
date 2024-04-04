export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Disease {
    id: number;
    code: string;
    name: string;
    cause: string;
    solution: string;
}

export interface Symptom {
    id: number;
    code: string;
    name: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
    dashboardCounts: {
        symptomsCount: number;
        diseasesCount: number;
        usersCount: number;
        adminsCount: number;
    };
    isAdmin: boolean;
    users: Array<User>;
    disease: Disease;
    diseases: Array<Disease>;
    symptom: Symptom;
    symptoms: Array<Symptom>;
};
