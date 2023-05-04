import Api from "../../services/api";

export const HAuth = () => ({
    validateToken: async (token: string) => {
        const response = await Api.post('/auth/me');
        return response;
    },
    login: async (email: string, password: string) => {
        const response = await Api.post('/auth/login', {
            email: email,
            password: password
        });
        return response.data;
    },
    logout: async () => {
        const respose = await Api.post('/auth/logout');
        return respose.data;
    }
});