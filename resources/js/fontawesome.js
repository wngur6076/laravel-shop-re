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
    faCashRegister, faMoneyCheck, faSortDown,
    faAngleLeft, faShoppingCart, faUserCog, faPlus
} from '@fortawesome/free-solid-svg-icons';

import {

} from '@fortawesome/free-brands-svg-icons';

library.add(
        faCaretUp,
        faCaretDown,
        faStar,
    faCheck, faSpinner, faArrowUp, faAngleRight, faSignInAlt, faHome,
    faCashRegister, faMoneyCheck, faSortDown, faAngleLeft, faShoppingCart, faUserCog,
        faPlus
    );
    // Kicks off the process of finding <i> tags and replacing with <svg>
    dom.watch();
