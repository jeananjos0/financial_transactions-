import { Route, Routes } from "react-router-dom";

//Auth
import { RequireAuth } from "./contexts/Auth/RequireAuth";

//Layout
import DefaultLogin from "./layout/login";
import LayoutDefault from "./layout/default";

//pages
import Login from "./pages/login";
import DashboardPage from "./pages/dashboard";
import TransactionsPage from "./pages/transactions";
import ProfilePage from "./pages/profile";
import UsersPage from "./pages/admin/users";


export default function Router() {

    return (
       
        <Routes>

            <Route element={<DefaultLogin />}>
                <Route path="/" element={<Login />} ></Route>
                <Route path="/login" element={<Login />} ></Route>
            </Route>

            <Route element={<RequireAuth role_id={[2, 1]}><LayoutDefault /></RequireAuth>}>
                <Route path="/dashboard" element={<DashboardPage />} />
                <Route path="/profile" element={<ProfilePage />} />
                <Route path="/transactions" element={<TransactionsPage />} />
            </Route>

            <Route element={<RequireAuth role_id={[1]}><LayoutDefault /></RequireAuth>}>
                <Route path="/usuarios" element={<UsersPage />} />
            </Route>

        </Routes>
    );
}