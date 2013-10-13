function getPortalUrl() {
  return "https://portal.yzu.edu.tw/";
}

function isPortalUrl(url) {
  return url.indexOf(getPortalUrl()) == 0;
}

function goToPortal() {
  chrome.tabs.getAllInWindow(undefined, function(tabs) {
    for (var i = 0, tab; tab = tabs[i]; i++) {
      if (tab.url && isPortalUrl(tab.url)) {
        chrome.tabs.update(tab.id, {selected: true});
        return;
      }
    }
    chrome.tabs.create({url: getPortalUrl() + 'index.aspx'});
  });
}

chrome.browserAction.onClicked.addListener(goToPortal);