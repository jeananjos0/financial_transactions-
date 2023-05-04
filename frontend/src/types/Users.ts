export type IUser = {
    id: number;
    fullname: string;
    email: string;
    password?: string;
    cpf_cnpj?: string;
    active?: number;
    role_id?: number;
    wallet_balance?: string;
    created_at: string;
    updated_at: number;
}