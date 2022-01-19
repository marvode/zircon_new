require('./bootstrap');

import { render } from "react-dom";
import { createInertiaApp } from "@inertiajs/inertia-react";
import { ChakraProvider, extendTheme } from "@chakra-ui/react";
import { InertiaProgress } from "@inertiajs/progress";

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

const theme = extendTheme({
    fonts: {
        body: "Barlow",
    },
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => import(`./Pages/${name}`),
    setup({ el, App, props }) {
        return render(
            <ChakraProvider theme={theme}>
                <App {...props} />
            </ChakraProvider>,
            el
        );
    },
});

InertiaProgress.init({ color: '#4B5563' });
