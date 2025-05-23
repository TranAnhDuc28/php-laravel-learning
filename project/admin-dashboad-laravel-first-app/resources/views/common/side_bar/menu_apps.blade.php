<li class="nav-item">
    <a class="nav-link menu-link {{ request()->is('apps*') ? '' : 'collapsed' }}" href="#sidebarApps"
       data-bs-toggle="collapse" role="button" aria-expanded="{{ request()->is('apps*') ? 'true' : 'false' }}" aria-controls="sidebarApps">
        <i class="ri-apps-2-line"></i> <span data-key="t-apps">Apps</span>
    </a>
    <div class="collapse menu-dropdown {{ request()->routeIs('app.*') ? 'show' : '' }}" id="sidebarApps">
        <ul class="nav nav-sm flex-column">
            @include('common.side_bar.menu_item_apps.item_calendar')

            <li class="nav-item">
                <a href="{{ route('app.chat') }}" class="nav-link {{ request()->routeIs('app.chat') ? 'active' : '' }}" data-key="t-chat">Chat</a>
            </li>

            <li class="nav-item">
                <a href="#sidebarEmail" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEmail" data-key="t-email">
                    Email
                </a>
                <div class="collapse menu-dropdown" id="sidebarEmail">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-mailbox.html" class="nav-link" data-key="t-mailbox">Mailbox</a>
                        </li>
                        <li class="nav-item">
                            <a href="#sidebaremailTemplates" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebaremailTemplates" data-key="t-email-templates">
                                Email Templates
                            </a>
                            <div class="collapse menu-dropdown" id="sidebaremailTemplates">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="apps-email-basic.html" class="nav-link" data-key="t-basic-action">Basic Action</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="apps-email-ecommerce.html" class="nav-link" data-key="t-ecommerce-action">Ecommerce Action</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarEcommerce" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce">Ecommerce</a>
                <div class="collapse menu-dropdown" id="sidebarEcommerce">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-ecommerce-products.html" class="nav-link" data-key="t-products"> Products </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-product-details.html" class="nav-link" data-key="t-product-Details"> Product Details </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-add-product.html" class="nav-link" data-key="t-create-product"> Create Product </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-orders.html" class="nav-link" data-key="t-orders">Orders </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-order-details.html" class="nav-link" data-key="t-order-details"> Order Details </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-customers.html" class="nav-link" data-key="t-customers"> Customers </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-cart.html" class="nav-link" data-key="t-shopping-cart"> Shopping Cart </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-checkout.html" class="nav-link" data-key="t-checkout"> Checkout </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-sellers.html" class="nav-link" data-key="t-sellers">Sellers </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-ecommerce-seller-details.html" class="nav-link" data-key="t-sellers-details"> Seller Details </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarProjects" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarProjects" data-key="t-projects">Projects</a>
                <div class="collapse menu-dropdown" id="sidebarProjects">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-projects-list.html" class="nav-link" data-key="t-list"> List</a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-projects-overview.html" class="nav-link" data-key="t-overview"> Overview </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-projects-create.html" class="nav-link" data-key="t-create-project"> Create Project </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarTasks" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTasks" data-key="t-tasks">Tasks</a>
                <div class="collapse menu-dropdown" id="sidebarTasks">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-tasks-kanban.html" class="nav-link" data-key="t-kanbanboard">Kanban Board </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-tasks-list-view.html" class="nav-link" data-key="t-list-view">List View </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-tasks-details.html" class="nav-link" data-key="t-task-details"> Task Details </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarCRM" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCRM" data-key="t-crm">CRM</a>
                <div class="collapse menu-dropdown" id="sidebarCRM">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-crm-contacts.html" class="nav-link" data-key="t-contacts">Contacts </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crm-companies.html" class="nav-link" data-key="t-companies">Companies </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crm-deals.html" class="nav-link" data-key="t-deals">Deals</a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crm-leads.html" class="nav-link" data-key="t-leads">Leads</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarCrypto" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCrypto" data-key="t-crypto">Crypto</a>
                <div class="collapse menu-dropdown" id="sidebarCrypto">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-crypto-transactions.html" class="nav-link" data-key="t-transactions"> Transactions </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crypto-buy-sell.html" class="nav-link" data-key="t-buy-sell">Buy & Sell </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crypto-orders.html" class="nav-link" data-key="t-orders">Orders </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crypto-wallet.html" class="nav-link" data-key="t-my-wallet">My Wallet </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crypto-ico.html" class="nav-link" data-key="t-ico-list"> ICO List </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-crypto-kyc.html" class="nav-link" data-key="t-kyc-application"> KYC Application </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarInvoices" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarInvoices" data-key="t-invoices">Invoices</a>
                <div class="collapse menu-dropdown" id="sidebarInvoices">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-invoices-list.html" class="nav-link" data-key="t-list-view">List View </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-invoices-details.html" class="nav-link" data-key="t-details">Details </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-invoices-create.html" class="nav-link" data-key="t-create-invoice"> Create Invoice </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarTickets" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarTickets" data-key="t-supprt-tickets">Support Tickets</a>
                <div class="collapse menu-dropdown" id="sidebarTickets">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-tickets-list.html" class="nav-link" data-key="t-list-view">List View </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-tickets-details.html" class="nav-link" data-key="t-ticket-details"> Ticket Details </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="#sidebarnft" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarnft" data-key="t-nft-marketplace">NFT Marketplace</a>
                <div class="collapse menu-dropdown" id="sidebarnft">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-nft-marketplace.html" class="nav-link" data-key="t-marketplace"> Marketplace </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-explore.html" class="nav-link" data-key="t-explore-now"> Explore Now </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-auction.html" class="nav-link" data-key="t-live-auction"> Live Auction </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-item-details.html" class="nav-link" data-key="t-item-details"> Item Details </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-collections.html" class="nav-link" data-key="t-collections"> Collections </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-creators.html" class="nav-link" data-key="t-creators"> Creators </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-ranking.html" class="nav-link" data-key="t-ranking"> Ranking </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-wallet.html" class="nav-link" data-key="t-wallet-connect"> Wallet Connect </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-nft-create.html" class="nav-link" data-key="t-create-nft"> Create NFT </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="apps-file-manager.html" class="nav-link"> <span data-key="t-file-manager">File Manager</span></a>
            </li>
            <li class="nav-item">
                <a href="apps-todo.html" class="nav-link"> <span data-key="t-to-do">To Do</span></a>
            </li>
            <li class="nav-item">
                <a href="#sidebarjobs" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarjobs" data-key="t-jobs">Jobs</a>
                <div class="collapse menu-dropdown" id="sidebarjobs">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a href="apps-job-statistics.html" class="nav-link" data-key="t-statistics"> Statistics </a>
                        </li>
                        <li class="nav-item">
                            <a href="#sidebarJoblists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarJoblists" data-key="t-job-lists">Job Lists</a>
                            <div class="collapse menu-dropdown" id="sidebarJoblists">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="apps-job-lists.html" class="nav-link" data-key="t-list"> List</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="apps-job-grid-lists.html" class="nav-link" data-key="t-grid"> Grid </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="apps-job-details.html" class="nav-link" data-key="t-overview"> Overview</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="#sidebarCandidatelists" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarCandidatelists" data-key="t-candidate-lists">Candidate Lists</a>
                            <div class="collapse menu-dropdown" id="sidebarCandidatelists">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="apps-job-candidate-lists.html" class="nav-link" data-key="t-list-view"> List View</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="apps-job-candidate-grid.html" class="nav-link" data-key="t-grid-view"> Grid View</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a href="apps-job-application.html" class="nav-link" data-key="t-application"> Application </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-job-new.html" class="nav-link" data-key="t-new-job">New Job </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-job-companies-lists.html" class="nav-link" data-key="t-companies-list"> Companies List </a>
                        </li>
                        <li class="nav-item">
                            <a href="apps-job-categories.html" class="nav-link" data-key="t-job-categories"> Job Categories</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a href="apps-api-key.html" class="nav-link" data-key="t-api-key">API Key</a>
            </li>
        </ul>
    </div>
</li>
