import { createContext } from "react";
import { IUser } from "../../types/Users"; 

export type AuthContextType = {
    user: IUser | null;
    tokenInvalid?: any;
    login: (email: string, password: string) => Promise<boolean>;
    logout: () => void;
}

export const AuthContext = createContext<AuthContextType>(null!);