<?php
namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Meal;
use App\Models\Order;
use App\Models\Cost;
use App\Models\Project;


use Illuminate\Support\Facades\Auth;


use Prism\Prism\Prism;
use Prism\Prism\Enums\Provider;

class AiController extends Controller
{

    public $systemPrompt;

    /**
     * Get the system prompt with language-specific instructions
     */
    private function getSystemPrompt()
    {
        $projectInfo = json_encode(Project::where('user_id', Auth::user()->id)->first());
        $prompt = "You are an expert business consultant and data analyst. Always analyze the provided data deeply, consider user and project context (Project Data: $projectInfo), The Currency Is The Project Country Currency You Must Get It.  deliver your advice in a clear, concise, and professional manner. My Project Info  Format your response as bullet points, using HTML <ul> and <li> tags, and make important keywords or phrases bold using <b> tags for Blade rendering. If your answer is long, continue until you provide at least 7 detailed bullet points.";

        $this->systemPrompt = $prompt;


        if (app()->getLocale() == 'ar') {
            $prompt .= ' ' . __('ai.response_in_arabic');
        }

        return $prompt;
    }

    public function suggestions()
    {
        // جمع البيانات
        $clientsCount = Client::count();
        $MealsCount = Meal::count();
        $OrdersCount = Order::count();
        $costsCount = Cost::count();
        $recentClients = Client::orderBy('created_at', 'desc')->take(3)->get(['name', 'email', 'phone']);
        $recentMeals = Meal::orderBy('created_at', 'desc')->take(3)->get(['name', 'price']);
        $project = Project::first();
        $user = Auth::user();


        $userPrompt = "My name is $user->name. Here is my business and project information:\n\n<b>User Information:</b>\n<ul>\n<li><b>Name:</b> $user->name</li>\n<li><b>Email:</b> $user->email</li>\n<li><b>Role:</b> ".($user->role ?? 'N/A')."</li>\n</ul>\n\n<b>Project Details:</b>\n<ul>\n<li><b>Project Name:</b> ".$project->name."</li>\n<li><b>Description:</b> ".$project->description."</li>\n<li><b>Address:</b> ".($project->address ?? 'N/A')."</li>\n</ul>\n\n<b>Clients Count:</b> $clientsCount<br>\n<b>Meals Count:</b> $MealsCount<br>\n<b>Orders Count:</b> $OrdersCount<br>\n<b>Costs Count:</b> $costsCount<br>\n<b>Recent Clients:</b> ".json_encode($recentClients)."<br>\n<b>Recent Meals:</b> ".json_encode($recentMeals)."<br>\n\nPlease analyze all this data and provide a detailed, actionable business analysis with the following goals:\n<ul>\n<li><b>Increase Mealion and Orders</b> with specific strategies.</li>\n<li><b>Expand the client base</b> and suggest how to sell to these specific clients, including personalized convincing techniques.</li>\n<li>Identify clients who have not purchased for a long time and suggest notification/reminder strategies to re-engage them.</li>\n<li><b>Reduce costs</b> with practical recommendations.</li>\n<li>Advise on the <b>best Meals in the market</b>, current trends, and market direction to help with purchasing decisions.</li>\n</ul>\nFormat your response as an HTML <ul> list, using <b> tags for important words or phrases, so it can be rendered directly in a Blade template. Make sure your response contains at least 7 detailed bullet points. If the answer is long, continue until you complete all points.";



        $response = Prism::text()
            ->using(Provider::Gemini, 'gemini-2.0-flash')
            ->withSystemPrompt($this->getSystemPrompt())
            ->withPrompt($userPrompt)
            ->withProviderOptions(['searchGrounding' => true])
            ->withMaxTokens(1500)
            ->generate();



        return view('ai.suggestions', [
            'response' => $response->text
        ]);
    }

    public function clientsAnalysis() {
        $clients = json_encode(Client::all());

        $userPrompt = "Analyze all provided customer data comprehensively ($clients), including demographics, purchase history, engagement patterns, feedback, and any available psychographic information. Consider the project location: [Specify Project Location]. Based solely on this data, identify precise, actionable strategies to significantly increase customer acquisition, build strong customer loyalty, and effectively motivate purchase decisions for this specific customer base.

        Avoid generic advice.Instead, provide:

        Targeted Acquisition Tactics: Identify specific under-tapped customer segments within the data and outline precise, data-driven campaigns or outreach methods to attract them.
        Loyalty Enhancement Programs: Based on observed customer behaviors and preferences, propose specific loyalty initiatives (e.g., 'Customers who purchased Meal A and B within 3 months respond well to early access for Meal C. Offer them X incentive.').
        Purchase Motivation & Conversion Strategies:
        For distinct customer segments identified in the data, detail the primary drivers and hesitations influencing their purchase decisions.
        Provide specific, fixed phrases (scripts) to use in customer interactions (e.g., Orders calls, support chats, email responses) designed to address these drivers/hesitations and guide them towards a purchase.
        For each phrase, explain why it is effective for that particular customer segment, referencing their data profile (e.g., 'For customers exhibiting price sensitivity and prior interest in feature Y, say:'I understand value is important to you. Our [Meal Name] not only includes feature Y, which you've shown interest in, but also comes with [Specific Value Proposition like warranty/support/discount] making it a smart investment.' This phrase works because...').
        Effective Upselling/Cross-selling Techniques: Based on purchase patterns, identify specific Meal/service combinations and provide exact phrasing to suggest relevant additional purchases to specific customer types at opportune moments (e.g., 'For customers who just bought Meal Z, and previously showed interest in Category Q, offer: 'Since you're getting Meal Z, many of our customers who also like Category Q find Meal R to be a perfect complement. Would you like to hear more about how it enhances Meal Z?').
        Deliver direct, data-driven, and immediately implementable customer engagement and Orders conversion tactics tailored exclusively to the analyzed data and project context.'
        ";


        try {
            $response = Prism::text()
            ->using(Provider::Gemini, 'gemini-2.0-flash')
            ->withSystemPrompt($this->getSystemPrompt())
            ->withPrompt($userPrompt)
            ->withMaxTokens(1500)
            ->generate()
            ->text;

            return view('ai.suggestions', [
                'response' => $response
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('msg' , __('app.check'));
        }
        
    }
    public function mealsAnalysis() {
        $Meals = json_encode( Meal::all());


        $userPrompt = "Analyze current Meal data, customer data, and project specifics ($Meals). Identify the precise target market. Provide actionable, professional recommendations for Meal improvement by pinpointing current, specific market trends and trending Meals directly relevant to this project's field. Deliver direct, data-driven insights on high-demand Meals and real-world market dynamics. Avoid generic advice; focus on specific, verifiable trends and concrete improvement strategies.";

        try {
            $response = Prism::text()
            ->using(Provider::Gemini, 'gemini-2.0-flash')
            ->withSystemPrompt($this->getSystemPrompt())
            ->withPrompt($userPrompt)
            ->withMaxTokens(1500)
            ->generate()
            ->text;

            return view('ai.suggestions', [
                'response' => $response
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('msg' , __('app.check'));
        }
    }

    public function ordersAnalysis() {
        $Orders =  json_encode(Order::all());

        $userPrompt = "Analyze all provided Orders data in detail ($Orders),  including transaction specifics, customer segments, and Orders channels. Consider the project location. Identify concrete, highly specific strategies to maximize Orders for this project. I need actionable recommendations, not generic advice. For example, instead of 'identify best-selling Meals,' tell me 'Meal X is experiencing high demand with a Y% increase in Orders in [Specific Region/Channel]; prioritize increasing its stock by Z units and feature it in upcoming promotions targeting [Specific Customer Segment].' Pinpoint precise opportunities for Orders growth, including underperforming areas with clear improvement steps, and identify specific Meals or services that require strategic focus (e.g., upselling, bundling, targeted marketing) based on current Orders performance and market demand within the specified location. Deliver direct, data-driven, and immediately implementable Orders enhancement tactics.";


        try {
            $response = Prism::text()
            ->using(Provider::Gemini, 'gemini-2.0-flash')
            ->withSystemPrompt($this->getSystemPrompt())
            ->withPrompt($userPrompt)
            ->withMaxTokens(1500)
            ->generate()
            ->text;

            return view('ai.suggestions', [
                'response' => $response
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('msg' , __('app.check'));
        }
    }

    public function costsAnalysic() {
        $costs = json_encode(Cost::all());

        $userPrompt = "Analyze all provided cost data comprehensively ($costs) , including but not limited to operational expenses, procurement costs, marketing spend, overheads, and any other project-related expenditures. Consider the project's nature and operational context. Your primary objective is to identify concrete, actionable strategies for maximizing cost reduction without negatively impacting essential quality, output, or core project objectives.

        Specifically, you must:

        Identify Specific Overpriced Items/Services: Pinpoint exact line items or categories where current expenditures appear higher than industry benchmarks or where more cost-effective alternatives likely exist. For each, state the current cost and the identified area of overspending.
        Propose Cheaper Alternatives (Equal Value): For each identified overpriced item/service, suggest specific, researched alternative suppliers, materials, services, or process changes that offer comparable or identical value/quality at a demonstrably lower cost. Provide estimated potential savings.
        Identify Non-Essential Costs for Elimination: Scrutinize all expenses to identify any costs that are non-essential, redundant, or provide minimal return on investment relative to their expenditure. Clearly list these costs and justify why they can be eliminated or significantly reduced without adverse effects.
        Highlight Inefficient Processes Leading to Excess Costs: Analyze cost patterns to identify any operational inefficiencies, wastages, or suboptimal processes that are inflating costs. Suggest specific process improvements to rectify these and quantify potential savings.
        Prioritize Recommendations by Impact: Present your cost reduction recommendations prioritized by their potential financial impact and ease of implementation.
        Avoid generic advice like 'negotiate with suppliers' or 'reduce waste.' Instead, provide specific, verifiable examples and actionable steps. For instance, rather than 'find cheaper software,' suggest 'Software X, currently costing Y, can be replaced by Software Z which offers similar features for [Specific Lower Price], potentially saving [Amount].' Or, 'The recurring subscription for Service A, costing B, was used only twice last quarter according to usage data; recommend termination to save B.' Focus entirely on data-driven, precise, and implementable cost-saving measures.";

        try {
            $response = Prism::text()
            ->using(Provider::Gemini, 'gemini-2.0-flash')
            ->withSystemPrompt($this->getSystemPrompt())
            ->withPrompt($userPrompt)
            ->withMaxTokens(1500)
            ->generate()
            ->text;

            return view('ai.suggestions', [
                'response' => $response
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('msg' , __('app.check'));
        }
    }
    public function projectsAnalysis() {
        $userPrompt = "Based only on Project information, provide a detailed, actionable plan for the project's development and    sustainable growth. Avoid generic business advice. Instead, focus on concrete steps tailored to the provided details:

        Leveraging Identity & Location:
        Based on the Project Name, suggest 2-3 potential unique selling propositions (USPs) or core brand identities that could be developed. Explain your reasoning.
        Considering the Project Location, identify 2-3 specific local opportunities (e.g., untapped local market segments, potential local partnerships, relevant local trends, community engagement tactics) that could be exploited for growth. Be specific to the nature of a project in that type of location.
        Initial Market Understanding & Validation:
        Outline 3-4 specific, low-cost methods this project could immediately use to better understand its target audience and validate its core offering, considering its current stage (implied by the basic data provided). Example: 'Conduct 5 short interviews with potential customers in [Project Location] focusing on X need,' not 'Do market research.'
        Actionable Growth Strategies (Next 3-6 Months):
        Propose 2-3 specific, initial growth strategies. These should be practical for a project with potentially limited resources. For each strategy, briefly describe the first 2-3 steps to implement it. Example: 'Strategy: Localized Content Marketing. Step 1: Identify 3 topics relevant to [Project Location/Potential Audience based on Name/Notes]. Step 2: Create short blog posts/social media updates on these topics. Step 3: Share on local community forums or groups.'
        Interpreting Notes for Action:
        If notes are provided, explicitly state how each key piece of information from the 'Notes/Description' directly informs or modifies your recommendations for development and growth. What specific actions should be taken based on those notes?
        Your output should be a clear, step-by-step guide offering tangible actions rather than abstract concepts. Assume the project is in an early to mid-stage of development unless the notes explicitly state otherwise. Focus on practical first steps for continuous improvement and expansion using the given information as the sole basis for your strategic advice.";

        try {
            $response = Prism::text()
            ->using(Provider::Gemini, 'gemini-2.0-flash')
            ->withSystemPrompt($this->getSystemPrompt())
            ->withPrompt($userPrompt)
            ->withMaxTokens(1500)
            ->generate()
            ->text;

            return view('ai.suggestions', [
                'response' => $response
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('msg' , __('app.check'));
        }
    }
}
