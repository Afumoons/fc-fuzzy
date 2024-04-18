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
    rulebases: Array<Rulebase>;
}

export interface Symptom {
    id: number;
    code: string;
    name: string;
    rulebases: Array<Rulebase>;
}

export interface Rulebase {
    id: number;
    disease_id: number;
    symptom_id: number;
    value: boolean;
}

export interface UserInput {
    id: number;
    user_id: number;
    symptom_id: number;
    value: boolean;
    symptom: Symptom;
}

export interface RulebaseHistory {
    id: number;
    user_id: number;
    disease_id: number;
    user: User;
    disease: Disease;
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
    rulebase: Rulebase;
    rulebases: Array<Rulebase>;
    userInput: UserInput;
    userInputs: Array<UserInput>;
    rulebaseHistory: RulebaseHistory;
    rulebaseHistorys: Array<RulebaseHistory>;
};
