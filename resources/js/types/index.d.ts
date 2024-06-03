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
    fuzzy_rules: Array<FuzzyRule>;
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

export interface FuzzyRule {
    id: number;
    disease_id: number;
    // data: JSON;
    data: {
        antecedent: Array<string>,
        consequent: {
            TingkatKeparahan: string
        },
    };
}

export interface RulebaseUserInput {
    id: number;
    user_id: number;
    symptom_id: number;
    value: boolean;
    symptom: Symptom;
}

export interface FuzzyUserInput {
    id: number;
    user_id: number;
    symptom_id: number;
    fuzzy_history_id: number;
    value: string;
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
    logo: string;
    users: Array<User>;
    disease: Disease;
    diseases: Array<Disease>;
    symptom: Symptom;
    symptoms: Array<Symptom>;
    rulebase: Rulebase;
    rulebases: Array<Rulebase>;
    fuzzyRule: FuzzyRule;
    fuzzyRules: Array<FuzzyRule>;
    rulebaseUserInput: RulebaseUserInput;
    rulebaseUserInputs: Array<RulebaseUserInput>;
    fuzzyUserInput: FuzzyUserInput;
    fuzzyUserInputs: Array<FuzzyUserInput>;
    rulebaseHistory: RulebaseHistory;
    rulebaseHistories: Array<RulebaseHistory>;
    statements: Array<string>;
};
