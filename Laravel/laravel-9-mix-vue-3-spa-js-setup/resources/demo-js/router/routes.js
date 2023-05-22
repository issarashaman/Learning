import pageRoutes from "./modules/pageRoutes";
import authRoutes from "./modules/authRoutes";
import consoleRoutes from "./modules/consoleRoutes";
import errorRoutes from "./modules/errorRoutes";

const routes = [
    ...pageRoutes,
    ...authRoutes,
    ...consoleRoutes,
    ...errorRoutes,
];

export default routes;
