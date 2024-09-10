import {PageProps as InertiaPageProps} from '@inertiajs/core'
import {AxiosInstance} from "axios";
import {route as ziggyRoute} from 'ziggy-js'
import {PageProps as AppPageProps} from './'

declare global {
    interface Window {
        axios: AxiosInstance;
    }

    export namespace inertia {
        export interface Props {
            user: {
                id: number;
                name: string;
                email: string;
                createdAt: Date;
                updatesAt: Date;
            };
            errors: unknown;
        }
    }

    var route: typeof ziggyRoute
}

declare module 'vue' {
    interface ComponentCustomProperties {
        route: typeof ziggyRoute
    }
}

declare module '@inertiajs/core' {
    interface PageProps extends InertiaPageProps, AppPageProps {}
}
