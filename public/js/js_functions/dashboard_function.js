function Dashboard(){

}

Dashboard.prototype.displayView = async function(){
    let contentWrapper = document.querySelector('.jsContentBody') || '';
    
    await loader.start();
    let view = await fetchGlobal.fetchViewData('/dashboard_view') || '';
    contentWrapper.innerHTML = '';
    contentWrapper.appendChild(new DOMParser().parseFromString(view,'text/html').querySelector('.dashboard-container-wrapper'));
    loader.stop();
}

export default function displayDashboard(){
    const cc = new Dashboard();
    cc.displayView();
}