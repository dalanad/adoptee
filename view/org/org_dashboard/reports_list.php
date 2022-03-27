<h2 style="text-align: center;font-weight:400">Available Reports</h3>
<div class="grid">
    <a href="/OrgManagement/animals_report" class="report-item">
        <img src="/assets/images/org/reports/animals.svg" class="report-img">
        Animal Details</a>&emsp;&emsp;
    <a href="/OrgManagement/adoptions_updates" class="report-item">
        <img src="/assets/images/org/reports/adoption_updates.svg" class="report-img">
        Adoptions Updates</a> &emsp;&emsp;
    <a href="/OrgManagement/rescue_to_adoption" class="report-item">
        <img src="/assets/images/org/reports/rescue_time.svg" class="report-img">
        Rescue To Adoption</a> &emsp;&emsp;
    <a href="/OrgManagement/rescues_information" class="report-item">
        <img src="/assets/images/org/reports/ambulance.png" class="report-img">
        Rescues Information</a> &emsp;&emsp;
    <!-- <a href="/OrgManagement/donations_summary" class="report-item">
        <img src="/assets/images/org/reports/donate.png" class="report-img">
        Donations Summary</a> &emsp;&emsp; -->
</div>

<style>
    .grid {
        justify-content: center;
        align-items: center;
        display: flex;
        flex-wrap: wrap
    }

    .report-item {
        display: block;
        margin: 1rem 0;
        width: 180px;
        padding: 1rem;
        height: 150px;
        background: white;
        box-shadow: var(--shadow-light);
        border-radius: 1rem;
        text-decoration: none;
        color: black;
        font-weight: 400;
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--muted);
    }

    .report-img {
        height: 100px;
        margin-bottom: 1.5rem;
    }

    .report-item:hover {
        cursor: pointer;
        background: #fafafa;
    }
</style>