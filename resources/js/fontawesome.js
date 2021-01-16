import { config, library, dom } from '@fortawesome/fontawesome-svg-core';
config.autoReplaceSvg = 'nest';

import {
        faCaretUp,
        faCaretDown,
        faStar,
        faCheck,
        faSpinner,
        faArrowUp,
        faAngleRight,
        faSignInAlt,
    faHome,
        faCashRegister, faMoneyCheck
} from '@fortawesome/free-solid-svg-icons';

import {

} from '@fortawesome/free-brands-svg-icons';

library.add(
        faCaretUp,
        faCaretDown,
        faStar,
    faCheck, faSpinner, faArrowUp, faAngleRight, faSignInAlt, faHome,
        faCashRegister, faMoneyCheck
    );
    // Kicks off the process of finding <i> tags and replacing with <svg>
    dom.watch();
