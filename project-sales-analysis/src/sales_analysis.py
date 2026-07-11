import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
import seaborn as sns

sns.set(style="whitegrid")


def generate_sales_data():
    np.random.seed(42)
    dates = pd.date_range(start="2024-01-01", periods=90, freq="D")
    products = ["Product A", "Product B", "Product C"]
    regions = ["North", "South", "East", "West"]

    data = []
    for date in dates:
        for product in products:
            for region in regions:
                quantity = np.random.poisson(lam=20)
                price = np.random.uniform(10, 50)
                revenue = quantity * price
                data.append({
                    "date": date,
                    "product": product,
                    "region": region,
                    "quantity": quantity,
                    "price": round(price, 2),
                    "revenue": round(revenue, 2),
                })

    return pd.DataFrame(data)


def analyze_sales(df):
    print("--- Tổng doanh thu ---")
    print(df["revenue"].sum())

    print("\n--- Doanh thu theo sản phẩm ---")
    print(df.groupby("product")["revenue"].sum().sort_values(ascending=False))

    print("\n--- Doanh thu theo khu vực ---")
    print(df.groupby("region")["revenue"].sum().sort_values(ascending=False))

    print("\n--- Doanh thu theo ngày ---")
    daily = df.groupby("date")["revenue"].sum()
    print(daily.head())

    return daily


def plot_trends(daily):
    plt.figure(figsize=(12, 6))
    sns.lineplot(x=daily.index, y=daily.values)
    plt.title("Doanh thu theo thời gian")
    plt.xlabel("Ngày")
    plt.ylabel("Doanh thu")
    plt.tight_layout()
    plt.savefig("sales_trend.png")
    plt.close()
    print("Đã lưu biểu đồ vào sales_trend.png")


def main():
    df = generate_sales_data()
    daily = analyze_sales(df)
    plot_trends(daily)


if __name__ == "__main__":
    main()
