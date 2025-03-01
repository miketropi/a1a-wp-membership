import './userLoginHandle';
import './search';

import { createRoot } from 'react-dom/client';
import MembershipApp from './MembershipApp';

((w, $) => {
  'use strict';

  const MembershipInit = () => {
    const rootElem = document.getElementById('MEMBERSHIP-DASHBOARD-ROOT');
    if(!rootElem) return;

    const root = createRoot(rootElem);
    root.render(<MembershipApp />);
  }

  $(() => {
    MembershipInit();
  })
})(window, jQuery);